<?php namespace Keios\ProUser\Updates;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use October\Rain\Database\Updates\Migration;

/**
 * Class CreateImportStatusTable
 * @package Keios\ProUser\Updates
 */
class CreateImportStatusTable extends Migration
{

    public function up()
    {
        Schema::create('keios_prouser_import_status', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id');
            $table->boolean('is_migrated');
        });
    }

    public function down()
    {
        Schema::dropIfExists('keios_prouser_import_status');
    }

}
