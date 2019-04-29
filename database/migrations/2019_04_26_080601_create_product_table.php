<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('title');
            $table->string('code');
            $table->string('title_url');
            $table->string('code_url');
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('view');
            $table->text('text')->nullable();
            $table->smallInteger('product-status')->nullable();
            $table->smallInteger('bon')->nullable();
            $table->smallInteger('show_product')->nullable();
            $table->smallInteger('product_number')->nullable();
            $table->smallInteger('order_product')->nullable();// tedad froosh

            $table->text('keywords')->nullable();
            $table->smallInteger('special')->nullable();
            $table->text('description')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
