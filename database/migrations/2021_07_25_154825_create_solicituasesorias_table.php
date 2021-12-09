<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicituasesoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //'justificacion','estado','idEstudiantes','idMateria'
        Schema::create('solicituasesorias', function (Blueprint $table) {
            $table->increments('idSolicituAsesorias');
            $table->string('justificacion');
            $table->string('estado');
            
            $table->unsignedInteger('idEstudiantes'); 
            $table->foreign('idEstudiantes')->references('idEstudiantes')->on('estudiantes');

            $table->unsignedInteger('idMateria'); 
            $table->foreign('idMateria')->references('idMateria')->on('materias');

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
        Schema::dropIfExists('solicituasesorias');
    }
}
