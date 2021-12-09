<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesorias extends Model
{
    use HasFactory;
    protected $table = 'asesorias';

    protected $primaryKey = 'idAsesorias';
    protected $fillable=['fechaAsesoria', 'horaInicio', 'horaFinal', 'Estudiantes_id', 'Docentes_id', 'idSolicitud'];
}
