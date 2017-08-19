<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('orders_info', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('order_id')->unsigned();
		    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
		    $table->char('name');
		    $table->char('phone');
		    $table->string('address');
		    $table->char('email')->nullable();
		    $table->tinyInteger('payment_type');
		    $table->string('comment')->nullable();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('orders_info');
    }
}
