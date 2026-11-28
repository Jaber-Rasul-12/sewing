<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingTypeExpenses extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_type_expenses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_type_expenses');
    }
}
