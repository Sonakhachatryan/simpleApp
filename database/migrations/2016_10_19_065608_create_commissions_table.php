<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('marketer_id')->unsigned();
            $table->foreign('marketer_id')
                ->references('id')
                ->on('marketers')
                ->onDelete('cascade')
                ->unUpdate('cascade');
            $table->decimal('commissios', 6, 2)->notNullable()->default(0.0);
            $table->decimal('payed', 6, 2)->notNullable()->default(0.0);
            $table->dateTime('payment_date')->nullable();
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
        //
    }
}
