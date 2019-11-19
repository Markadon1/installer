<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_template', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');
            $table->integer('template_id')->unsigned();
            $table->foreign('template_id')->references('id')->on('subcat-input');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('category_template');
    }
}
