<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrederProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oreder_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oreder_id');
            $table->foreign('oreder_id')->on('oreders')->references('id')->onDelete("cascade");;
            $table->foreignId('product_id');
            $table->foreign('product_id')->on('products')->references('id')->onDelete("cascade");;
            $table->integer('count');
            $table->double('item_price');
            $table->float('total');
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
        Schema::dropIfExists('oreder_products');
    }
}
