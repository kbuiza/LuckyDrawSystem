<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('winning_number1')->unique();
            $table->integer('winning_number2')->nullable()->unique();
            $table->integer('winning_number3')->nullable()->unique();
            $table->integer('winning_number4')->nullable()->unique();
            $table->integer('winning_number5')->nullable()->unique();
            $table->boolean('winned')->default(0);
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
        Schema::dropIfExists('persons');
    }
}
