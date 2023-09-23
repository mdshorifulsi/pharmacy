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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('product_name');
            $table->string('generic_name')->nullable();
            $table->string('unit_power')->nullable();
            $table->string('discount')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('mrp')->nullable();
            $table->string('best_price')->nullable();
            $table->string('manufacture_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('product_image')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->integer('status')->default(1);

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

                $table->foreign('brand_id')
                ->references('id')->on('brands')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
};
