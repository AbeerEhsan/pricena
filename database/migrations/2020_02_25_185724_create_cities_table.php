<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')
                  ->on('languages')
                  ->references('id')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                  ->on('countries')
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
        Schema::dropIfExists('cities');
    }
}
