<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosalumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horariosalumnos', function (Blueprint $table) {
            $table->increments('idHorariosAlumnos');
            
           /* $table->unsignedInteger('Horarios_idHorarios'); 
            $table->foreign('Horarios_idHorarios')->references('idSolicituAsesorias')->on('solicituasesorias');
*/
            $table->unsignedInteger('idHorarios'); 
            $table->foreign('idHorarios')->references('idHorarios')->on('horarios');

            $table->unsignedInteger('idEstudiantes'); 
            $table->foreign('idEstudiantes')->references('idEstudiantes')->on('estudiantes');


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
        Schema::dropIfExists('horariosalumnos');
    }
}
