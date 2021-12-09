<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('idHorarios');

            $table->unsignedInteger('iddia'); 
            $table->foreign('iddia')->references('idDia')->on('dias');

            $table->time('HoraInicial');
            $table->time('HoraFinal');

            $table->unsignedInteger('idMateria'); 
            $table->foreign('idMateria')->references('idMateria')->on('materias');

            $table->unsignedInteger('idModalidades'); 
            $table->foreign('idModalidades')->references('idModalidades')->on('modalidades');

            $table->unsignedInteger('idSemestres'); 
            $table->foreign('idSemestres')->references('idSemestres')->on('semestres');

            $table->unsignedInteger('id_docente'); 
            $table->foreign('id_docente')->references('idDocentes')->on('docentes');

      
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
        Schema::dropIfExists('horarios');
    }
}
