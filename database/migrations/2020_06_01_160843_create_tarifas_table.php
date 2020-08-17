<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarifasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarifas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title', 40);
            $table->integer('duration')->nullable();
            $table->string('description', 500)->nullable();
            $table->string('caracteristiques', 500);
            $table->decimal('price');
            $table->unsignedBigInteger('assessor_id');
            $table->foreign('assessor_id')
                ->references('id')
                ->on('assessors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarifas');
    }
}
