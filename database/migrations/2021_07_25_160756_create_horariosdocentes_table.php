<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorariosdocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horariosdocentes', function (Blueprint $table) {
            $table->increments('idHorariosDocentes');

            $table->unsignedInteger('Horarios_id'); 
            $table->foreign('Horarios_id')->references('idHorarios')->on('horarios');

            $table->unsignedInteger('Docentes_id'); 
            $table->foreign('Docentes_id')->references('idDocentes')->on('docentes');


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
        Schema::dropIfExists('horariosdocentes');
    }
}
