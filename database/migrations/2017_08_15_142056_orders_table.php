<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('orders', function (Blueprint $table) {
		    $table->increments('id');
		    $table->integer('user_id')->default(0);
		    $table->decimal('total_price',10, 2)->default(0.00);
		    $table->char('post_n')->default('n/a');
		    $table->tinyInteger('status')->default(1);
		    $table->timestamps();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('orders');
    }
}
