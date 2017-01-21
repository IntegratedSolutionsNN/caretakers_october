<?php namespace Keios\ProUser\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateCountriesTable
 * @package Keios\ProUser\Updates
 */
class CreateCountriesTable extends Migration
{

    public function up()
    {
        Schema::create('keios_prouser_countries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->boolean('is_enabled')->default(false);
            $table->string('name')->index();
            $table->string('code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keios_prouser_countries');
    }

}
