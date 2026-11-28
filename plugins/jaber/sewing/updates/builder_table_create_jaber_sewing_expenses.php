<?php namespace Jaber\Sewing\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class BuilderTableCreateJaberSewingExpenses extends Migration
{
    public function up()
    {
        Schema::create('jaber_sewing_expenses', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('type_expense_id')->unsigned();
            $table->double('amount', 10, 0);
            $table->date('expense_date');
            $table->string('notes');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->foreign('type_expense_id')
                    ->references('id')
                    ->on('jaber_sewing_type_expenses')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('jaber_sewing_expenses');
    }
}
