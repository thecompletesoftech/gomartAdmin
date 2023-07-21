<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->string('user_id')->nullable();
            $table->string('driver_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('item_id')->nullable();
            $table->string('order_amount');
            $table->string('order_type');
            $table->string('order_status')->comment('0:driverpending, 1:orderaccepted,2:ordercomplete,3:ordercancel,4:intransit');
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

};