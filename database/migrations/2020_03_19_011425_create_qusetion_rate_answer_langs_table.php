<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQusetionRateAnswerLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qusetion_rate_answer_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')
                ->on('qusetion_rate_answers')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')
                ->on('languages')
                ->references('id')
                ->onDelete('cascade');

            $table->string('answer');

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
        Schema::dropIfExists('qusetion_rate_answer_langs');
    }
}
