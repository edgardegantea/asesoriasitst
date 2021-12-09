<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorarioExtraescolarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarioextraescolar', function (Blueprint $table) {
            $table->increments('idHorarioExtraescolar');

            $table->unsignedInteger('iddia'); 
            $table->foreign('iddia')->references('idDia')->on('dias');

            $table->time('HoraInicial');
            $table->time('HoraFinal');
            
            $table->string('consideraciones', 100);

            $table->unsignedInteger('idExtraescolar'); 
            $table->foreign('idExtraescolar')->references('idExtraescolar')->on('extraescolares');   

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
        Schema::dropIfExists('horario_extraescolar');
    }
}
