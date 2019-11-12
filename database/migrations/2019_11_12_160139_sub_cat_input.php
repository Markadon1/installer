<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SubCatInput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategory_input', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')->references('id')->on('subcategory');
            $table->integer('input_id')->unsigned();
            $table->foreign('input_id')->references('id')->on('subcat-input');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('subcategory_input');
    }
}
