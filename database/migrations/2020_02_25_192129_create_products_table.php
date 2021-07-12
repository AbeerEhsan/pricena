<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku')->nullable();
            $table->string('img');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                  ->on('categories')
                  ->references('id')
                  ->onDelete('cascade');
            $table->text('Barcode')->nullable();
            $table->text('link')->nullable();      
            $table->boolean('is_main')->default(0);
            $table->integer('visits')->default(0);
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
        Schema::dropIfExists('products');
    }
}
