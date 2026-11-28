<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingOrderItems extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_order_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->integer('material_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('purchase_id')->unsigned();
            $table->integer('quantity');
            $table->double('unit_price', 10, 0);
            $table->double('total', 10, 0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('order_id')
                    ->references('id')
                    ->on('jaber_sewing_orders')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')
                    ->references('id')
                    ->on('jaber_sewing_models')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('material_id')
                    ->references('id')
                    ->on('jaber_sewing_materials')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id')
                    ->references('id')
                    ->on('jaber_sewing_units')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('purchase_id')
                    ->references('id')
                    ->on('jaber_sewing_purchases')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_order_items');
    }
}
