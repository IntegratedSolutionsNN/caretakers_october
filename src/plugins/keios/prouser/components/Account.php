<?php

namespace Keios\ProUser\Components;

use Keios\ProUser\Classes\AuthManager;
use Keios\ProUser\Models\Settings as UserSettings;
use October\Rain\Exception\ValidationException;
use October\Rain\Exception\AjaxException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use October\Rain\Support\Facades\Flash;
use Keios\Apparatus\Facades\Resolver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Auth;
use Keios\ProUser\Models\User;
use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Exception;
use DB;

/**
 * Class Account
 *
 * @package Keios\ProUser
 */
class Account extends ComponentBase {

    /**
     * @return array
     */
    public function componentDetails() {
        return [
            'name' => 'keios.prouser::lang.account_component.name',
            'description' => 'keios.prouser::lang.account_component.description',
        ];
    }

    /**
     * @return array
     */
    public function defineProperties() {
        return [
            'redirect' => [
                'title' => 'keios.prouser::lang.account_component.redirect_title',
                'description' => 'keios.prouser::lang.account_component.redirect_description',
                'type' => 'dropdown',
                'default' => '',
            ],
            'migratedPage' => [
                'title' => 'keios.prouser::lang.account_component.migrated_page_title',
                'description' => 'keios.prouser::lang.account_component.migrated_page_description',
                'type' => 'dropdown',
                'default' => '',
            ],
            'connectto' => [
                'title' => 'keios.prouser::lang.account_component.connectto_finish',
                'description' => 'keios.prouser::lang.account_component.connectto_finish_desc',
                'type' => 'checkbox',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getMigratedPageOptions() {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * @return array
     */
    public function getRedirectOptions() {
        return ['' => '- none -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    /**
     * @return string
     */
    public function getRedirect() {
        return $this->property('redirect');
    }

    /**
     * Executed when this component is bound to a page or layout.
     */
    public function onRun() {

        $countries = \Keios\ProUser\Models\Country::rememberForever('countries')->get();

        $user = \Auth::getUser();
        if ($user) {
            $userCountry = \Keios\ProUser\Models\Country::where('id', $user->country_id)->first();
            $this->page['user_country'] = $userCountry;
        }
        $this->page['countries'] = $countries;
        $this->page['user'] = $this->user();
    }

    /**
     * Returns the logged in user, if available
     */
    public function user() {
        if (!Auth::check()) {
            return null;
        }

        return Auth::getUser();
    }

    /**
     * Signs in the user
     *
     * @return null
     * @throws AjaxException
     * @throws ValidationException
     */
    public function onSignin() {
        /*
         * Validate input
         */
        $data = post();
        $rules = [
            'password' => 'required|min:2',
        ];

        $loginAttribute = UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);

        if ($loginAttribute == UserSettings::LOGIN_USERNAME) {
            $rules['login'] = 'required|between:2,64';
        } else {
            $rules['email'] = 'required|email|between:2,64';
        }

        if (!in_array('login', $data)) {
            $data['login'] = post('username', post('email'));
        }

        $messages = [
            "required" => Lang::get('keios.prouser::lang.validation.required'),
            "email" => Lang::get('keios.prouser::lang.validation.email'),
            "between" => Lang::get('keios.prouser::lang.validation.between'),
            "min" => Lang::get('keios.prouser::lang.validation.min'),
        ];

        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /*
         * Authenticate user
         */
        try {
            $user = Auth::authenticate(
                            [
                        'login' => array_get($data, 'login'),
                        'password' => array_get($data, 'password'),
                            ], true
            );
        } catch (Exception $ex) {
            $isMigrated = $this->checkMigrationStatus($data['login']);
            if ($isMigrated === "0") {
                return Redirect::to($this->pageUrl($this->property('migratedPage')));
            } else {
                throw new AjaxException(
                ['X_OCTOBER_ERROR_MESSAGE' => Lang::get('keios.prouser::lang.messages.login')]
                );
            }
        }

        /*
         * Redirect to the intended page after successful sign in
         */
        $redirectUrl = $this->pageUrl($this->property('redirect'));

        if ($redirectUrl = post('redirect', $redirectUrl)) {
            Flash::success(trans('keios.prouser::lang.flash.hello') . $user->first_name . '!');

            return Redirect::intended($redirectUrl);
        }

        return null;
    }

    /**
     * @param string $login
     *
     * @return null|integer
     */
    private function checkMigrationStatus($login) { //todo
        $manager = AuthManager::instance();
        $user = $manager->findUserByLogin($login);

        if ($user) {
            $userState = DB::table('keios_prouser_import_status')
                    ->where('user_id', $user->id)
                    ->first();
            if ($userState) {
                $migrateStatus = $userState->is_migrated;
            } else {
                $migrateStatus = null;
            }
        } else {
            $migrateStatus = null;
        }

        return $migrateStatus;
    }

    /**
     * Register the user
     *
     * @return null|Redirect
     * @throws ValidationException
     */
    public function onRegister() {
        /*
         * Validate input
         */
        $data = post();

        $rules = [
            'email' => 'required|email|between:2,64',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];

        $loginAttribute = UserSettings::get('login_attribute', UserSettings::LOGIN_EMAIL);
        if ($loginAttribute == UserSettings::LOGIN_USERNAME) {
            $rules['username'] = 'required|between:2,64';
        }

        $messages = [
            "required" => Lang::get('keios.prouser::lang.validation.required'),
            "email" => Lang::get('keios.prouser::lang.validation.email'),
            "between" => Lang::get('keios.prouser::lang.validation.between'),
            "min" => Lang::get('keios.prouser::lang.validation.min'),
        ];

        $validation = Validator::make($data, $rules, $messages);
        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        /*
         * Register user
         */
        $requireActivation = UserSettings::get('require_activation', true);
        $automaticActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_AUTO;
        $userActivation = UserSettings::get('activate_mode') == UserSettings::ACTIVATE_USER;
        $user = Auth::register($data, $automaticActivation);

        /*
         * Check if related models are to be constructed during registration
         */
        $this->buildRelatedModels($data, $user);

        /*
         * Activation is by the user, send the email
         */
        if ($userActivation) {
            $this->sendActivationEmail($user);
            Flash::success(trans('keios.prouser::lang.flash.check_email'));
        }

        /*
         * Automatically activated or not required, log the user in
         */
        if ($automaticActivation || !$requireActivation) {
            Auth::login($user);

            if ($mailTemplate = UserSettings::get('welcome_template')) {
                $this->sendWelcomeEmail($user, $mailTemplate);
            }
        }

        /*
         * Redirect to the intended page after successful sign in
         */
        $redirectUrl = $this->pageUrl($this->property('redirect'));

        if ($redirectUrl = post('redirect', $redirectUrl)) {
            return Redirect::intended($redirectUrl);
        }

        return null;
    }

    /**
     * On update method.
     *
     * @return Redirect|null
     * @throws AjaxException
     * @throws Exception
     */
    public function onUpdate() {
        if (!$user = $this->user()) {
            return null;
        }
        $data = post();

        /* additional check for modern Semantic form */
        if (array_key_exists('phone_prefix', $data)) {
            $fullPhone = str_replace('+', '', $data['phone_prefix']) . $data['phone'];
            $data['phone'] = $fullPhone;
        }

        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->street = $data['street'];
        $user->zip = $data['zip'];
        $user->city = $data['city'];
        $user->country_id = $data['country_id'];
        if (array_key_exists('state_id', $data)) {
            $user->state_id = $data['state_id'];
        }
        if (array_key_exists('password', $data) && array_key_exists('password_confirmation', $data)) {
            if ($data['password'] && $data['password_confirmation']) {
                $user->password = $data['password'];
                $user->password_confirmation = $data['password_confirmation'];
            }
        }
        $user->save();

        /*
          // todo - not sure why fill doesn't work properly
          if (array_key_exists('country_id', $data)) {
          $user->country_id = $data['country_id'];
          }
          if (array_key_exists('state_id', $data)) {
          $user->state_id = $data['state_id'];
          }
         */
        $user->save();
        if (!$this->property('connectto')) {
            try {
                Auth::authenticate(
                        [
                    'login' => post('login_current'),
                    'password' => post('password_current'),
                        ], true
                );
            } catch (Exception $ex) {
                throw new AjaxException(
                ['X_OCTOBER_ERROR_MESSAGE' => Lang::get('keios.prouser::lang.messages.login')]
                );
            }
        } else {
            $this->updateConnectTo($user);
        }

        $user->save();

        $this->updateRelatedModels(post(), $user);

        /*
         * Password has changed, reauthenticate the user
         */
        if (strlen(post('password'))) {
            Auth::login($user->reload(), true);
        }

        Event::fire('prouser.user.updated', [$user, $data = post()]);

        Flash::success(post('flash', trans('keios.prouser::lang.flash.settings_saved')));

        /*
         * Redirect to the intended page after successful update
         */

        return Redirect::to($this->pageUrl($this->property('redirect')));
    }

    /**
     * Updates entry in ConnectTo table. Triggered if ConnectTo is enabled in component.
     *
     * @param User $user
     *
     * @throws Exception
     */
    private function updateConnectTo($user) {
        \DB::beginTransaction();
        try {
            \DB::table('keios_connectto_user_providers')
                    ->where('user_id', $user->id)
                    ->update(
                            [
                                'signup_finished' => true,
                            ]
            );
        } catch (Exception $e) {
            \DB::rollback();
            throw new Exception($e); //todo
        }
        \DB::commit();
    }

    /**
     * Trigger a subsequent activation email
     *
     * @param bool|true $isAjax
     *
     * @return Redirect|null
     * @throws Exception
     */
    public function onSendActivationEmail($isAjax = true) {
        try {
            $user = $this->user();
            if (!$user) {
                throw new Exception(trans('keios.prouser::lang.flash.you_must_login'));
            }

            if ($user->is_activated) {
                throw new Exception(trans('keios.prouser::lang.flash.already_active'));
            }

            Flash::success(trans('keios.prouser::lang.flash.email_sent'));

            $this->sendActivationEmail($user);
        } catch (Exception $ex) {
            if ($isAjax) {
                throw $ex;
            } else {
                Flash::error($ex->getMessage());
            }
        }

        /*
         * Redirect
         */
        $redirectUrl = $this->pageUrl($this->property('redirect'));

        if ($redirectUrl = post('redirect', $redirectUrl)) {
            return Redirect::to($redirectUrl);
        }

        return null;
    }

    /**
     * Sends the activation email to a user
     *
     * @param  User $user
     *
     */
    protected function sendActivationEmail($user) {
        $code = implode('!', [$user->id, $user->getActivationCode()]);
        $link = URL::to(Resolver::resolveParameterizedRouteTo('userActivator', 'activationCode', $code));

        $data = [
            'name' => $user->firstName,
            'link' => $link,
            'code' => $code,
        ];

        Mail::send(
                'keios.prouser::mail.activate', $data, function ($message) use ($user) {
            $message->to($user->email, $user->firstName . ' ' . $user->lastName);
        }
        );
    }

    /**
     * @param $user
     * @param $mailTemplate
     */
    protected function sendWelcomeEmail($user, $mailTemplate) {
        $data = [
            'name' => $user->first_name,
            'email' => $user->email,
        ];

        Mail::send(
                $mailTemplate, $data, function ($message) use ($user) {
            $message->to(
                    $user->email, $user->first_name . ' ' . $user->last_name
            );
        }
        );
    }

    /**
     * @param array $data
     * @param User  $user
     */
    protected function buildRelatedModels(array $data, User $user) {
        $relations = [];
        $permittedRelations = ['hasMany', 'hasOne', 'attachOne', 'attachMany'];

        /*
         * Find relations and fields from related models
         */
        foreach ($data as $field => $value) {
            if (is_array($value)) {
                $relation = $field;

                if (is_null($relationDefinition = $user->getRelationDefinition($relation))) {
                    continue;
                }

                $relationType = $user->getRelationType($relation);

                if (!in_array($relationType, $permittedRelations)) {
                    continue;
                }

                if (!array_key_exists($relation, $relations)) {
                    $relations[$relation] = [];
                    $relations[$relation]['class'] = $relationDefinition[0];
                    $relations[$relation]['fields'] = [];
                }

                foreach ($value as $trueField => $fieldValue) {
                    $relations[$relation]['fields'][$trueField] = $fieldValue;
                }
            }
        }

        /*
         * Apply related models to user account
         */

        foreach ($relations as $relation => $relationData) {
            $relatedModelClass = $relationData['class'];
            $relatedModelInstance = new $relatedModelClass($relationData['fields']);
            $relatedModelInstance->save();
            $user->$relation = $relatedModelInstance;
            $user->password_confirmation = $data['password_confirmation']; // dirty hack for faulty self-validating model
            $user->save();
        }
    }

    /**
     * @param array $data
     * @param User  $user
     */
    protected function updateRelatedModels(array $data, User $user) {
        $relations = [];
        $permittedRelations = ['hasOne', 'attachOne'];

        /*
         * Find relations and fields from related models
         */
        foreach ($data as $field => $value) {
            if (is_array($value)) {
                $relation = $field;

                $relationType = $user->getRelationType($relation);

                if (is_null($relationDefinition = $user->getRelationDefinition($relation))) {
                    continue;
                }

                if (!in_array($relationType, $permittedRelations)) {
                    continue;
                }

                if (!array_key_exists($relation, $relations)) {
                    $relations[$relation] = [];
                    $relations[$relation]['class'] = $relationDefinition[0];
                    $relations[$relation]['fields'] = [];
                }

                foreach ($value as $trueField => $fieldValue) {
                    $relations[$relation]['fields'][$trueField] = $fieldValue;
                }
            }
        }

        /*
         * Apply related models to user account
         */

        foreach ($relations as $relation => $relationData) {
            /**
             * @var \October\Rain\Database\Model $relatedModel
             */
            $relatedModel = $user->$relation;

            if (is_null($relatedModel)) {
                $modelClass = $relationData['class'];
                $relatedModel = new $modelClass($relationData['fields']);
                $relatedModel->save();
                $user->$relation = $relatedModel;
                $user->save();
            } else {
                $relatedModel->fill($relationData['fields']);
                $relatedModel->save();
            }
        }
    }

}
