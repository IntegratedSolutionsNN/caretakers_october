<?php namespace Keios\ProUser\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateMailBlockersTable
 * @package Keios\ProUser\Updates
 */
class CreateMailBlockersTable extends Migration
{

    public function up()
    {
        Schema::create('keios_prouser_mail_blockers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email')->index()->nullable();
            $table->string('template')->index()->nullable();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keios_prouser_mail_blockers');
    }

}
