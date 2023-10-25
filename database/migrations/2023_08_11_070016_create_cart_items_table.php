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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('item_id');
            $table->string('item_name');
            $table->string('item_weight');
            $table->string('item_quantity');
            $table->string('item_price');
            $table->string('item_image');
            $table->string('item_description');
            $table->string('dis_item_price')->nullable()->default(0);
            $table->string('promocode_discount')->nullable()->default(0);
            $table->string('item_expiry_date');
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
        Schema::dropIfExists('cart_items');
    }
};
