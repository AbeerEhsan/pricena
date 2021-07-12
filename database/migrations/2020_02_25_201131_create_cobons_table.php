<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('maxUser');
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
        Schema::dropIfExists('cobons');
    }
}
