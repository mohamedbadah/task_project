<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOredersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oreders', function (Blueprint $table) {
            $table->id();
            $table->float('total-couble');
            $table->enum('payment_txp', ['foo', 'bar']);
            $table->enum('status', ['active', 'disable'])->default('disable');
            $table->foreignId('users_id');
            $table->foreign('users_id')->on('users')->references('id');
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
        Schema::dropIfExists('oreders');
    }
}
