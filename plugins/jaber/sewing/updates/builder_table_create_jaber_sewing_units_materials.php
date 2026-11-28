<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingUnitsMaterials extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_units_materials', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('unit_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->primary(['unit_id','material_id']);
            $table->foreign('unit_id')
                    ->references('id')
                    ->on('jaber_sewing_units')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material_id')
                    ->references('id')
                    ->on('jaber_sewing_materials')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_units_materials');
    }
}
