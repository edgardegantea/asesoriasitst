<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vista_HorarioAlumnos extends Model
{
    use HasFactory;
    protected $table = 'vista_horarioalumnos';
    protected $primaryKey = 'idHorariosAlumnos';
}
