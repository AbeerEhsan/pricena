<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQusetionRateLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qusetion_rate_langs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('question');

            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id')
                ->on('qusetion_rates')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')
                ->on('languages')
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
        Schema::dropIfExists('qusetion_rate_langs');
    }
}
