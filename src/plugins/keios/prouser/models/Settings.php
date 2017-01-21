<?php namespace Keios\ProUser\Models;

use Lang;
use Model;
use System\Models\MailTemplate;

/**
 * Class Settings
 *
 * @package Keios\ProUser\Models
 */
class Settings extends Model
{
    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var string
     */
    public $settingsCode = 'user_settings';
    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    const ACTIVATE_AUTO = 'auto';

    const ACTIVATE_USER = 'user';

    const ACTIVATE_ADMIN = 'admin';

    const LOGIN_EMAIL = 'email';

    const LOGIN_USERNAME = 'username';

    public function initSettingsData()
    {
        $this->require_activation = true;
        $this->activate_mode = self::ACTIVATE_AUTO;
        $this->use_throttle = true;
        $this->default_country = 1;
        $this->default_state = 1;
        $this->welcome_template = 'keios.prouser::mail.welcome';
        $this->login_attribute = self::LOGIN_EMAIL;
    }

    /**
     * @return array
     */
    public function getDefaultCountryOptions()
    {
        return Country::getNameList();
    }

    /**
     * @return mixed
     */
    public function getDefaultStateOptions()
    {
        return State::getNameList($this->default_country);
    }

    /**
     * @return array
     */
    public function getActivateModeOptions()
    {
        return [
            self::ACTIVATE_AUTO => ['keios.prouser::lang.settings.activate_mode_auto', 'keios.prouser::lang.settings.activate_mode_auto_comment'],
            self::ACTIVATE_USER => ['keios.prouser::lang.settings.activate_mode_user', 'keios.prouser::lang.settings.activate_mode_user_comment'],
            self::ACTIVATE_ADMIN => ['keios.prouser::lang.settings.activate_mode_admin', 'keios.prouser::lang.settings.activate_mode_admin_comment'],
        ];
    }

    /**
     * @return array
     */
    public function getLoginAttributeOptions()
    {
        return [
            self::LOGIN_EMAIL => ['keios.prouser::lang.login.attribute_email'],
            self::LOGIN_USERNAME => ['keios.prouser::lang.login.attribute_username'],
        ];
    }

    /**
     * @param $value
     *
     * @return string
     */
    public function getActivateModeAttribute($value)
    {
        if (!$value)
            return self::ACTIVATE_AUTO;

        return $value;
    }

    /**
     * @return array
     */
    public function getWelcomeTemplateOptions()
    {
        return ['' => '- ' . Lang::get('keios.prouser::lang.settings.no_mail_template') . ' -'] + MailTemplate::orderBy('code')->lists('code', 'code');
    }
}