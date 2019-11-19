<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TemplateInput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_input', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('templates');
            $table->integer('input_id')->unsigned();
            $table->foreign('input_id')->references('id')->on('temp-inputs');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('template_input');
    }
}
