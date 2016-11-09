<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar');
            $table->string('alias');
            $table->enum('status', ['gold', 'silver']);
            $table->string('payment_id');
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('pinterest')->nullable();
            $table->text('about')->nullable();
            $table->integer('marketer_id')->unsigned();
            $table->foreign('marketer_id')
                ->references('id')
                ->on('marketers')
                ->onDelete('cascade')
                ->unUpdate('cascade');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
