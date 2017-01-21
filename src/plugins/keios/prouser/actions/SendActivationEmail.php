<?php namespace Keios\ProUser\Actions;

use Keios\Apparatus\Core\SideAction;
use Keios\ProUser\Models\Settings as UserSettings;

/**
 * Class SendActivationEmail
 *
 * @package Keios\ProUser\Actions
 */
class SendActivationEmail extends SideAction
{

    /**
     * Sends activation e-mail
     *
     * @param $user
     *
     * @return mixed|void
     */
    public function execute($user)
    {
        if (UserSettings::get('activate_mode') == UserSettings::ACTIVATE_USER) {

            $code = implode('!', [$user->id, $user->getActivationCode()]);

            $link = \URL::to(\Resolver::resolveParameterizedRouteTo('userActivator', 'activationCode', $code));

            $data = [
                'name' => $user->firstName,
                'link' => $link,
                'code' => $code,
            ];

            \Mail::send(
                'keios.prouser::mail.activate',
                $data,
                function ($message) use ($user) {
                    $message->to($user->email, $user->firstName.' '.$user->lastName);
                }
            );
        }
    }
}