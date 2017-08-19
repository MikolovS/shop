<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTableShop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('users', function($table)
	    {
		    $table->char('phone')->nullable();
		    $table->string('address')->nullable();
		    $table->tinyInteger('payment_type')->default(1);
		    $table->string('comment')->nullable();

		    $table->renameColumn('name', 'login')->nullable()->change();
//		    $table->string('login')->nullable()->change();
	    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('users', function($table)
	    {
		    $table->renameColumn('login', 'name');
		    $table->dropColumn(['phone', 'address', 'payment_type', 'comment']);
	    });
    }
}
