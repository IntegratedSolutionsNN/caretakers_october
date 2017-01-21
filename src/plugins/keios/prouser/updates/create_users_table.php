<?php namespace Keios\ProUser\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateUsersTable
 * @package Keios\ProUser\Updates
 */
class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('keios_prouser_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->index();
            $table->string('username')->unique()->nullable()->index();
            $table->string('password');
            $table->string('activation_code')->nullable()->index();
            $table->string('persist_code')->nullable();
            $table->string('reset_password_code')->nullable()->index();
            $table->text('permissions')->nullable();
            $table->boolean('is_activated')->default(0);
            $table->boolean('is_blocked')->default(0);
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->integer('country_id')->unsigned()->nullable()->index();
            $table->integer('state_id')->unsigned()->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keios_connectto_providers');
        Schema::dropIfExists('keios_prouser_users');
    }

}