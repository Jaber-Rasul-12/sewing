<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingPurchases extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_purchases', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->date('purchase_date');
            $table->double('unit_price', 10, 0);
            $table->double('quantity', 10, 0);
            $table->double('total_price', 10, 0);
            $table->text('uuid');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('material_id')
                    ->references('id')
                    ->on('jaber_sewing_materials')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id')
                    ->references('id')
                    ->on('jaber_sewing_units')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')
                    ->references('id')
                    ->on('jaber_sewing_suppliers')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_purchases');
    }
}
