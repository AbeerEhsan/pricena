<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('data');
            $table->unsignedBigInteger('lang_id');
            $table->foreign('lang_id')
                  ->on('languages')
                  ->references('id')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('notification_id');
            $table->foreign('notification_id')
                  ->on('notifications')
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
        Schema::dropIfExists('notification_langs');
    }
}
