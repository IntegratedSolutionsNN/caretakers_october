<?php namespace Keios\ProUser\Actions;

use Keios\ProUser\Models\Settings as UserSettings;
use Keios\Apparatus\Core\SideAction;
use Mail;

/**
 * Class SendWelcomeEmail
 *
 * @package Keios\ProUser\Actions
 */
class SendWelcomeEmail extends SideAction
{

    /**
     * Sends welcome e-mail
     *
     * @param $actionResult
     *
     * @return mixed|void
     */
    public function execute($actionResult)
    {
        if (!$this->scenario->has('user')) {
            return;
        }

        if (!$mailTemplate = UserSettings::get('welcome_template')) {
            return;
        }

        $data = [
            'name'  => $this->scenario->user->first_name,
            'email' => $this->scenario->user->email,
        ];

        Mail::send(
            $mailTemplate,
            $data,
            function ($message) {
                $message->to(
                    $this->scenario->user->email,
                    $this->scenario->user->first_name.' '.$this->scenario->user->last_name
                );
            }
        );
    }
}