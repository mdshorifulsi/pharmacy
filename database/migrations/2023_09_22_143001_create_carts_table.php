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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
             $table->string('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('generic_name')->nullable();
            $table->string('unit_power')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_image')->nullable();
            $table->string('sub_total')->nullable();
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
        Schema::dropIfExists('carts');
    }
};
