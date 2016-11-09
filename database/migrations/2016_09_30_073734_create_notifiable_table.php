<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotifiableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifiable', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('notification_id')->unsigned();
            $table->foreign('notification_id')
                ->references('id')
                ->on('notifications')
                ->onDelete('cascade')
                ->unUpdate('cascade');
            $table->integer('notifiable_id')->unsigned();
            $table->string('notifiable_type');
            $table->string('url');
            $table->enum('status', ['viewed','not viewed']);
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
        Schema::drop('notifiable');
    }
}
