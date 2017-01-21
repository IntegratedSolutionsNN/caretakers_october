<?php namespace Keios\ProUser\Classes;

use Backend\Classes\AuthManager as BaseAuthManager;
use Keios\ProUser\Models\Settings as UserSettings;
use Keios\ProUser\Models\User;
use Session;
use Cookie;

/**
 * Class AuthManager
 *
 * @package Keios\ProUser\Classes
 */
class AuthManager extends BaseAuthManager
{
    /**
     * @var
     */
    protected static $instance;

    /**
     * @var string
     */
    protected $sessionKey = 'user_auth';

    /**
     * @var string
     */
    protected $userModel = 'Keios\ProUser\Models\User';

    /**
     * @var string
     */
    protected $groupModel = 'Keios\ProUser\Models\Group';

    /**
     * @var string
     */
    protected $throttleModel = 'Keios\ProUser\Models\Throttle';

    /**
     * @var bool
     */
    protected $useThrottle = true;

    /**
     * @var bool
     */
    protected $requireActivation = true;

    /**
     * @var bool
     */
    protected $noUserWithSuchId = false;

    /**
     * Initializes throttle and activation requirement
     */
    public function init()
    {
        $this->useThrottle = UserSettings::get('use_throttle', $this->useThrottle);
        $this->requireActivation = UserSettings::get('require_activation', $this->requireActivation);
        parent::init();
    }

    /**
     * Check to see if the user is logged in and activated,
     * and hasn't been banned or suspended.
     *
     * @return bool
     */
    public function check()
    {
        if ($this->noUserWithSuchId) {
            return false;
        }

        if (is_null($this->user)) {

            /*
             * Check session first, follow by cookie
             */
            if (!($userArray = Session::get($this->sessionKey)) && !($userArray = Cookie::get($this->sessionKey))) {
                return false;
            }

            /*
             * Check supplied session/cookie is an array (username, persist code)
             */
            if (!is_array($userArray) || count($userArray) !== 2) {
                return false;
            }

            list($id, $persistCode) = $userArray;

            /*
             * Look up user
             * Check cache first
             */
            $user = $this->createUserModel()->remember(5, 'keios.prouser::user_'.$id)->find($id);
            if (!$user) {
                $this->noUserWithSuchId = true;

                return false;
            }

            /*
             * Confirm the persistence code is valid, otherwise reject
             */
            if (!$user->checkPersistCode($persistCode)) {
                return false;
            }

            /*
             * Pass
             */
            $this->user = $user;
        }

        /*
         * Check cached user is activated
         */
        if (!$this->user || ($this->requireActivation && !$this->user->is_activated)) {
            return false;
        }

        /*
         * Throttle check
         */
        if ($this->useThrottle) {
            $throttle = $this->findThrottleByUserId($this->user->getKey());

            if ($throttle->is_banned || $throttle->checkSuspended()) {
                $this->logout();

                return false;
            }
        }

        if ($this->user->isBlocked) {
            return false;
        }

        return true;
    }

    /**
     * Login user and triggers afterLogin event
     *
     * @param User      $user
     * @param bool|true $remember
     *
     * @throws \October\Rain\Auth\AuthException
     */
    public function login($user, $remember = true)
    {
        parent::login($user, $remember);

        \Event::fire('keios.prouser.afterLogin', [$user]);
    }

    /**
     * Log outs user and triggers afterLogout event
     */
    public function logout()
    {
        $loggedOutUser = $this->user;

        parent::logout();

        \Event::fire('keios.prouser.afterLogout', [$loggedOutUser]);
    }

    /**
     * Registers user and triggers afterRegister event
     *
     * @param array      $credentials
     * @param bool|false $activate
     *
     * @return \October\Rain\Auth\User
     */
    public function register(array $credentials, $activate = false)
    {
        $user = parent::register($credentials, $activate);

        \Event::fire('keios.prouser.afterRegister', [$user]);

        return $user;
    }

    /**
     * Sets session key
     *
     * @param string $key
     */
    public function setSessionKey($key)
    {
        $this->sessionKey = $key;
    }

    /**
     * Checks if user has given permission
     *
     * @param string $permission
     *
     * @return bool
     */
    public function hasAccess($permission)
    {
        $user = $this->getUser();
        if ($user) {
            return $user->hasAccess($permission);
        } else {
            return false;
        }
    }

    /**
     * Provides User basing on his e-mail
     *
     * @param string $email
     *
     * @return User|null
     */
    public function findUserByEmail($email)
    {
        $model = $this->createUserModel();
        $user = $model->newQuery()->where('email', $email)->first();

        return $user ?: null;
    }

    /**
     * Provides User basing on his login
     *
     * @param string $login
     *
     * @return User
     */
    public function findUserByLogin($login)
    {
        $user = User::where('username', $login)->orWhere('email', $login)->first();

        return $user;
    }

    /**
     * Returns a list of the main menu items.
     *
     * @return array
     */
    public function listPermissions()
    {
        if ($this->permissionCache !== false) {
            return $this->permissionCache;
        }

        /*
         * Load module items
         */
        foreach ($this->callbacks as $callback) {
            $callback($this);
        }

        /*
         * Sort permission items
         */
        usort(
            $this->permissions,
            function ($a, $b) {
                if ($a->order == $b->order) {
                    return 0;
                }

                return $a->order > $b->order ? 1 : -1;
            }
        );

        return $this->permissionCache = $this->permissions;
    }
}