<?php namespace Keios\ProUser\Components;

use Auth;
use DB;
use Mail;
use Validator;
use Cms\Classes\ComponentBase;
use October\Rain\Exception\ValidationException;
use October\Rain\Exception\ApplicationException;

/**
 * Class ResetPassword
 *
 * @package Keios\ProUser\Components
 */
class ResetPassword extends ComponentBase
{

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'keios.prouser::lang.reset_password_component.name',
            'description' => 'keios.prouser::lang.reset_password_component.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [
            'paramCode' => [
                'title'       => 'keios.prouser::lang.reset_password_component.paramcode_title',
                'description' => 'keios.prouser::lang.reset_password_component.paramcode_description',
                'type'        => 'string',
                'default'     => 'code'
            ]
        ];
    }

    /**
     * Trigger the password reset email
     */
    public function onRestorePassword()
    {
        $rules = [
            'email' => 'required|email|min:2|max:32'
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        if (!($user = Auth::findUserByEmail(post('email')))) {
            throw new ApplicationException('A user was not found with the given credentials.');
        }

        $code = implode('!', [$user->id, $user->getResetPasswordCode()]);
        $link = $this->controller->currentPageUrl(
            [
                $this->property('paramCode') => $code
            ]
        );

        $data = [
            'name' => $user->name,
            'link' => $link,
            'code' => $code
        ];

        Mail::send(
            'keios.prouser::mail.restore',
            $data,
            function ($message) use ($user) {
                $message->to($user->email, $user->full_name);
            }
        );
    }

    /**
     * Perform the password reset
     */
    public function onResetPassword()
    {
        $rules = [
            'code'     => 'required',
            'password' => 'required|min:2'
        ];

        $validation = Validator::make(post(), $rules);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /*
         * Break up the code parts
         */
        $parts = explode('!', post('code'));
        if (count($parts) != 2) {
            throw new ValidationException(['code' => 'Invalid activation code supplied']);
        }

        list($userId, $code) = $parts;

        if (!strlen(trim($userId)) || !($user = Auth::findUserById($userId))) {
            throw new ApplicationException('A user was not found with the given credentials.');
        }

        if (!$user->attemptResetPassword($code, post('password'))) {
            throw new ValidationException(['code' => 'Invalid activation code supplied']);
        }
        
        \Event::fire('prouser.user.passwordReset', [$user, $newPassword = post('password')]);
	$this->updateMigrationStatus($userId);
    }

    /**
     * @param $userId
     */
    protected function updateMigrationStatus($userId)
    {
        $statusTable = 'keios_prouser_import_status';
        $isImported = DB::table($statusTable)->where('user_id', $userId)->first();
        if($isImported){
            DB::table($statusTable)->where('user_id', $userId)->update(['is_migrated' => 1]);
        }
    }

    /**
     * Returns the reset password code from the URL
     * @return string
     */
    public function code()
    {
        $routeParameter = $this->property('paramCode');

        return $this->param($routeParameter);
    }

}