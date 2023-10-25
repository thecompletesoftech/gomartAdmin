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
            $table->string('order_date')->nullable();
            $table->string('order_amount');
            $table->string('payment_method');
            $table->string('order_type');
            $table->string('order_status')->default(0)->comment('0:pending,1:complete,2:cancel');
            $table->timestamps();
            $table->softDeletes();
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