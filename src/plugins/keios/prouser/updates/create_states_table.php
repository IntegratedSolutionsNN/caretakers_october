<?php namespace Keios\ProUser\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateStatesTable
 * @package Keios\ProUser\Updates
 */
class CreateStatesTable extends Migration
{

    public function up()
    {
        Schema::create('keios_prouser_states', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('country_id')->unsigned()->index();
            $table->string('name')->index();
            $table->string('code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keios_prouser_states');
    }

}
