<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsesoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('asesorias', function (Blueprint $table) {
            $table->increments('idAsesorias');
            $table->date('fechaAsesoria');
            $table->time('horaInicio');
            $table->time('horaFinal');

            $table->unsignedInteger('Estudiantes_id'); 
            $table->foreign('Estudiantes_id')->references('idEstudiantes')->on('estudiantes');

            $table->unsignedInteger('Docentes_id'); 
            $table->foreign('Docentes_id')->references('idDocentes')->on('docentes');

            $table->unsignedInteger('idSolicitud'); 
            $table->foreign('idSolicitud')->references('idSolicituAsesorias')->on('solicituasesorias');
            
            $table->tinyInteger('ConfimacionDocente')->nullable();
            $table->tinyInteger('ConfirmacionAlumno')->nullable();

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
        Schema::dropIfExists('asesorias');
    }
}
