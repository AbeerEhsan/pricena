<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
                  ->on('products')
                  ->references('id')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('store_id');      
            $table->foreign('store_id')
                  ->on('stores')
                  ->references('id')
                  ->onDelete('cascade');
            $table->integer('price');
            $table->string('currency')->nullable();
            $table->integer('deliveryPrice')->nullable();
            $table->float('discount')->nullable();
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
        Schema::dropIfExists('product_stores');
    }
}
