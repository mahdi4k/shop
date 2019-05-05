<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeriveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name');
            $table->integer('product_id');
            $table->integer('parent_id');
            $table->string('date')->nullable();
            $table->integer('time')->nullable();
            $table->integer('color_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_serive');
    }
}
