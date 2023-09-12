<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->double('transaction_amount')->nullable();
            $table->string('token')->nullable();
            $table->string('description')->nullable();
            $table->string('email')->nullable();
            $table->integer('installments')->nullable();
            $table->string('payment_method_id')->nullable();
            $table->integer('issuer')->nullable();
            $table->string('doc_type')->nullable();
            $table->string('doc_number')->nullable();
            $table->string('status')->nullable();
            $table->string('status_detail')->nullable();
            $table->string('payment_id')->nullable();
            $table->boolean('updated')->default(false);
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
        Schema::dropIfExists('donations');
    }
}
