<?php namespace Keios\ProUser\Updates;

use Keios\ProUser\Models\Settings as UserSettings;
use October\Rain\Database\Updates\Migration;

/**
 * Class SeedMessagesSettings
 * @package Keios\ProUser\Updates
 */
class SeedMessagesSettings extends Migration
{

    public function up()
    {
        UserSettings::set('message_template', '#prouser-message-template');
        UserSettings::set('message_container', '#prouser-message-container');
        UserSettings::set('flash_message_type', '#prouser-flash-message-type');
        UserSettings::set('flash_message', '#prouser-flash-message');
        UserSettings::set('ready_event', 'ready');
        UserSettings::set('error_class', 'alert-danger');
        UserSettings::set('success_class', 'alert-success');
        UserSettings::set('warning_class', 'alert-warning');
        UserSettings::set('info_class', 'alert-info');
        UserSettings::set('message_timeout_animation_speed', 500);
        UserSettings::set('message_timeout', 3000);
        UserSettings::set('timeout_fadeout', true);
    }

    public function down()
    {

    }

}
