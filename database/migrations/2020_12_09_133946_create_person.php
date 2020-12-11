<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 200);
            $table->boolean('checked');
            $table->text('description');
            $table->string('interest')->nullable();
            $table->dateTimeTz('date_of_birth')->nullable();
            $table->string('email', 255);
            $table->bigInteger('account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}
