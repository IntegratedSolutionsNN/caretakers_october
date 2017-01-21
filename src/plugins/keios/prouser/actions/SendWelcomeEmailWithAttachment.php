<?php namespace Keios\ProUser\Actions;

use Keios\ProUser\Models\Settings as UserSettings;
use Keios\Apparatus\Core\SideAction;
use Mail;

/**
 * Class SendWelcomeEmailWithAttachment
 *
 * @package Keios\ProUser\Actions
 */
class SendWelcomeEmailWithAttachment extends SideAction
{
    /**
     * Sends welcome e-mail with attachment
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

                if ($this->scenario->has('attachment')) {

                    /**
                     * @var \October\Rain\Database\Attach\File|array $attachment
                     */
                    $attachment = $this->scenario->attachment;

                    if (is_array($attachment)) {

                        /**
                         * @var \October\Rain\Database\Attach\File $file
                         */
                        foreach ($attachment as $file) {
                            $message->attach(
                                $file->getDiskPath(),
                                ['as' => $file->getFilename(), 'mime' => $file->content_type]
                            );
                        }
                    } else {
                        $message->attach(
                            $attachment->getDiskPath(),
                            ['as' => $attachment->getFilename(), 'mime' => $attachment->content_type]
                        );
                    }
                }
            }
        );
    }
}