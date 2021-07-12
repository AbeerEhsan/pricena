<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->text('description');
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('new_id');
            $table->foreign('lang_id')
                  ->on('languages')
                  ->references('id')
                  ->onDelete('cascade');
            $table->foreign('new_id')
            ->on('news')
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
        Schema::dropIfExists('news_lang');
    }
}
