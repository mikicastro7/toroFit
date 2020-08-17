<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessorias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('pes')->nullable();
            $table->decimal('altura')->nullable();
            $table->mediumText('image')->nullable();
            $table->dateTime('data_inici');
            $table->dateTime('data_fi'); //date
            $table->mediumText('fitxer_rutina')->nullable();
            $table->mediumText('fitxer_dieta')->nullable();
            $table->longText('dades_Tarifa');
            $table->longText('comentari_assessor')->nullable();
            $table->longText('comentari_client')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('assessorias');
    }
}
