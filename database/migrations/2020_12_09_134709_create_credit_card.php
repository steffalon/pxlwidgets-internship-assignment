<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_card', function (Blueprint $table) {
            $table->id('person_id');
            $table->string('type');
            $table->bigInteger('number');
            $table->string('name');
            $table->date('expiration_date'); // challenge.json uses camelCase instead of snake_case

            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('credit_card');
    }
}
