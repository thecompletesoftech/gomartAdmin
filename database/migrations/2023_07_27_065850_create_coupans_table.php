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
        Schema::create('coupans', function (Blueprint $table) {
            $table->increments('coupan_id');
            $table->string('coupan_title');
            $table->string('discount')->default(0);
            $table->string('discount_type')->default('percentage')->comment('percentage,fixed');
            $table->string('store_id')->nullable();
            $table->string('coupon_desc');
            $table->string('expiry_date')->nullable();
            $table->string('coupan_status')->default(0)->comment('0:active,1:deactive');
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
        Schema::dropIfExists('coupans');
    }
};
