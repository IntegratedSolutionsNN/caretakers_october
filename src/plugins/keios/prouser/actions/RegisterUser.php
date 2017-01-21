<?php namespace Keios\ProUser\Actions;

use Keios\Apparatus\Core\Action;
use Keios\ProUser\Classes\AuthManager;
use Keios\ProUser\Models\Settings as UserSettings;

/**
 * Class RegisterUser
 *
 * @package Keios\ProUser\Actions
 */
class RegisterUser extends Action
{
    /**
     * Executes user registration procedure
     *
     * @param $result
     *
     * @return null
     */
    public function execute($result)
    {
        $user = null;
        // expect input array here

        $credentials = $this->scenario->getEventData();

        \DB::transaction(
            function () use (&$user, $credentials) {

                $automaticActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_AUTO;

                /**
                 * @var \Keios\ProUser\Models\User $user
                 */
                $user = AuthManager::instance()->register($credentials, $automaticActivation);

                $user->buildRelatedModels($credentials);
            }
        );

        $this->scenario->user = $user;

        return $user;
    }
}