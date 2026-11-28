<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingOrders extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_orders', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('model_id')->unsigned();
            $table->date('order_date');
            $table->date('due_date');
            $table->string('status');
            $table->integer('total');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('customer_id')
                    ->references('id')
                    ->on('jaber_sewing_customers')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('model_id')
                    ->references('id')
                    ->on('jaber_sewing_models')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_orders');
    }
}
