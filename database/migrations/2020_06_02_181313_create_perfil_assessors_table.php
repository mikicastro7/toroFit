<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilAssessorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_assessors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->longText('body')->nullable();
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
        Schema::dropIfExists('perfil_assessors');
    }
}
