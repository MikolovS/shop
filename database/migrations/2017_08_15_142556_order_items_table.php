<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('order_items', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('order_id')->unsigned();
		    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
		    $table->integer('product_id')->unsigned();
		    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
		    $table->integer('count');
		    $table->decimal('price',10, 2)->default(0.00);
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('order_items');
    }
}
