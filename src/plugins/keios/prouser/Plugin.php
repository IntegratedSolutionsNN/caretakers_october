<?php namespace Keios\ProUser;

use Event;
use Backend;
use Auth;
use System\Classes\PluginBase;
use Illuminate\Foundation\AliasLoader;
use Keios\ProUser\Models\MailBlocker;

/**
 * Class Plugin
 *
 * @package Keios\ProUser
 */
class Plugin extends PluginBase
{
    /**
     * @var array
     */
    public $require = [
        'Keios.Apparatus',
    ];

    /**
     * @var bool
     */
    public $elevated = true;

    /**
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'ProUser',
            'description' => 'keios.prouser::lang.app.description',
            'author'      => 'Alexey Bobkov, Samuel Georges, Keios',
            'icon'        => 'icon-user',
        ];
    }

    public function boot()
    {

    }

    /**
     * Registers alias loader, auth manager and mail blocking
     */
    public function register()
    {
        $alias = AliasLoader::getInstance();
        $alias->alias('Auth', 'Keios\ProUser\Facades\Auth');

        $this->app->singleton(
            'user.auth',
            function () {
                return \Keios\ProUser\Classes\AuthManager::instance();
            }
        );

        /*
         * Apply user-based mail blocking 
         */
        Event::listen(
            'mailer.prepareSend',
            function ($mailer, $view, $message) {
                return MailBlocker::filterMessage($view, $message);
            }
        );
    }

    /**
     * Registers plugin components
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Keios\ProUser\Components\Session'       => 'session',
            'Keios\ProUser\Components\Signin'        => 'signIn',
            'Keios\ProUser\Components\Register'      => 'register',
            'Keios\ProUser\Components\Account'       => 'account',
            'Keios\ProUser\Components\ResetPassword' => 'resetPassword',
            'Keios\ProUser\Components\Activator'     => 'userActivator',
        ];
    }

    /**
     * Registers controllers navigation
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'user' => [
                'label'       => 'keios.prouser::lang.app.label',
                'url'         => Backend::url('keios/prouser/users'),
                'icon'        => 'icon-user',
                'permissions' => ['users.access_users'],
                'order'       => 500,
                'sideMenu'    => [
                    'users'  => [
                        'label'       => 'keios.prouser::lang.app.side_label',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('keios/prouser/users'),
                        'permissions' => ['users.access_users'],
                    ],
                    'groups' => [
                        'label'       => 'keios.prouser::lang.app.groups',
                        'icon'        => 'icon-users',
                        'url'         => Backend::url('keios/prouser/groups'),
                        'permissions' => ['users.access_groups'],
                    ],
                ],

            ],
        ];
    }

    /**
     * Registers users settings
     *
     * @return array
     */
    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'keios.prouser::lang.app.user_settings',
                'description' => 'keios.prouser::lang.app.user_settings_description',
                'category'    => 'keios.prouser::lang.app.category',
                'icon'        => 'icon-cog',
                'class'       => 'Keios\ProUser\Models\Settings',
                'order'       => 500,
                'permissions' => ['users.access_settings'],
            ],
            'location' => [
                'label'       => 'keios.prouser::lang.app.location_label',
                'description' => 'keios.prouser::lang.app.location_description',
                'category'    => 'keios.prouser::lang.app.category',
                'icon'        => 'icon-globe',
                'url'         => Backend::url('keios/prouser/locations'),
                'order'       => 500,
                'permissions' => ['users.access_settings'],
            ],
        ];
    }

    /**
     * Registers e-mail templates
     *
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'keios.prouser::mail.activate' => 'Activation email sent to new users.',
            'keios.prouser::mail.welcome'  => 'Welcome email sent when a user is activated.',
            'keios.prouser::mail.restore'  => 'Password reset instructions for front-end users.',
            'keios.prouser::mail.new_user' => 'Sent to administrators when a new user joins.',
        ];
    }

    /**
     * Registers new Twig variables
     *
     * @return array
     */
    public function registerMarkupTags()
    {
        return [
            'functions' => [
                'form_select_country' => ['Keios\ProUser\Models\Country', 'formSelect'],
                'form_select_state'   => ['Keios\ProUser\Models\State', 'formSelect'],
                'hasAccess'           => function ($permission) {
                    return Auth::hasAccess($permission);
                },
                'hasGroup'            => function ($group) {
                    /**
                     * @var \Keios\ProUser\Models\User $user
                     */
                    $user = Auth::getUser();
                    if ($user) {
                        return $user->hasGroup($group);
                    } else {
                        return false;
                    }
                },
            ],
        ];
    }

    /**
     * Registers backend permissions
     *
     * @return array
     */
    public function registerPermissions()
    {
        return [
            'users.access_users'    => [
                'tab'   => 'keios.prouser::lang.app.label',
                'label' => 'keios.prouser::lang.permissions.access_users',
            ],
            'users.access_groups'   => [
                'tab'   => 'keios.prouser::lang.app.label',
                'label' => 'keios.prouser::lang.permissions.access_users_groups',
            ],
            'users.access_settings' => [
                'tab'   => 'keios.prouser::lang.app.label',
                'label' => 'keios.prouser::lang.permissions.access_settings',
            ],
        ];
    }

}