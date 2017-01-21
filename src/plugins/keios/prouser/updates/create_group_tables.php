<?php namespace Keios\ProUser\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateGroupsTables
 * @package Keios\ProUser\Updates
 */
class CreateGroupsTables extends Migration
{

    public function up()
    {
       Schema::create('keios_prouser_groups', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name')->unique();
            $table->text('permissions')->nullable();
            $table->timestamps();
        });

        // Creates the user to group (Many-to-Many relation) table
        Schema::create('keios_prouser_user_group', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->primary(array('user_id', 'group_id'));
        });

    }

    public function down()
    {
        Schema::drop('keios_prouser_user_group');
        Schema::drop('keios_prouser_groups');
    }

}
