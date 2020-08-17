<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessorEtiquetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessor_etiqueta', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('etiqueta_id');
            $table->foreign('etiqueta_id')
                ->references('id')
                ->on('etiquetas')
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
        Schema::dropIfExists('assessor_etiqueta');
    }
}
