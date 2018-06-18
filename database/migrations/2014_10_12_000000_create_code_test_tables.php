<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeTestTables extends Migration
{
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('surname');
            $table->unsignedInteger('shop_id');
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops');
        });

        Schema::create('rotas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shop_id');
            $table->date('week_commence_date');
            $table->timestamps();

            $table->foreign('shop_id')->references('id')->on('shops');
        });

        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rota_id');
            $table->unsignedInteger('staff_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();

            $table->foreign('rota_id')->references('id')->on('rotas')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('staff');
        });

        Schema::create('shift_breaks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shift_id');
            $table->dateTime('start_time');
            $table->dateTime('end_time');

            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shift_breaks');
        Schema::dropIfExists('shifts');
        Schema::dropIfExists('rotas');
        Schema::dropIfExists('staff');
        Schema::dropIfExists('shops');
    }
}
