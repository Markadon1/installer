<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp-card-val', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_id')->unsigned();
            $table->foreign('card_id')->references('id')->on('cards');
            $table->integer('value_id')->unsigned();
            $table->foreign('value_id')->references('id')->on('card_temp-val');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('temp-card-val');
    }
}
