<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingModels extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_models', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('code');
            $table->integer('category_id')->unsigned();
            $table->string('description')->nullable();
            $table->boolean('is_active');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('jaber_sewing_categories')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_models');
    }
}
