<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistaValidacionAlumno extends Model
{
    use HasFactory;
    protected $table = 'validacionasesorialumnos';
    protected $primaryKey = 'idAsesorias';

}
