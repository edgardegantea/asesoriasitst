<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('idEstudiantes');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('grupo',1);

            $table->unsignedInteger('Carreras_id'); 
            $table->foreign('Carreras_id')->references('idCarreras')->on('carreras');

            $table->unsignedInteger('Semestres_id'); 
            $table->foreign('Semestres_id')->references('idSemestres')->on('semestres');

            $table->unsignedInteger('Modalidades_id'); 
            $table->foreign('Modalidades_id')->references('idModalidades')->on('modalidades');

            $table->unsignedInteger('id_user'); 
            $table->foreign('id_user')->references('id_user')->on('users');

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
        Schema::dropIfExists('estudiantes');
    }
}
