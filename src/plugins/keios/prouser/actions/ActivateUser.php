<?php namespace Keios\ProUser\Actions;

use Keios\Apparatus\Core\Action;
use October\Rain\Exception\ApplicationException;
use October\Rain\Exception\ValidationException;

/**
 * Class ActivateUser
 *
 * @package Keios\ProUser\Actions
 */
class ActivateUser extends Action
{
    /**
     * Executes user activation procedure
     *
     * @param $lastStepResult
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws ApplicationException
     * @throws ValidationException
     * @throws \Exception
     */
    public function execute($lastStepResult)
    {
        list($code, $defaultRedirect) = $this->scenario->getEventData();

        /*
        * Break up the code parts
        */
        $parts = explode('!', $code);
        if (count($parts) != 2) {
            throw new ValidationException(['code' => trans('keios.prouser::lang.flash.invalid_code')]);
        }

        list($userId, $code) = $parts;

        /**
         * @var \Keios\ProUser\Models\User | null $user
         */
        if (!strlen(trim($userId)) || !($user = \Auth::findUserById($userId))) {
            throw new ApplicationException(trans('keios.prouser::lang.flash.user_not_found'));
        }

        if (!$user->attemptActivation($code)) {
            throw new ValidationException(['code' => trans('keios.prouser::lang.flash.invalid_code')]);
        }

        \Flash::success(trans('keios.prouser::lang.flash.activation_success'));

        /*
         * Sign in the user
         */
        \Auth::login($user);

        /*
         * Pass user instance to scenario for further usage
         */
        $this->scenario->user = $user;

        if (property_exists($this->scenario, 'overrideRedirect')) {
            return \Redirect::to($this->scenario->overrideRedirect);
        } else {
            return \Redirect::to($defaultRedirect);
        }
    }
}