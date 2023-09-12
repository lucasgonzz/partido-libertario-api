<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('dni')->nullable();
            $table->string('sex')->nullable();
            $table->integer('birth_year')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('dni_address')->nullable();
            $table->string('dni_city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('profesion')->nullable();
            $table->string('contacto')->nullable();
            $table->integer('departament_id')->nullable();
            
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
        Schema::dropIfExists('affiliates');
    }
}
