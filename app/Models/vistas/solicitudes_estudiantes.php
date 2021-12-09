<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudes_estudiantes extends Model
{
    use HasFactory;
    protected $table = 'solicitudes_estudiantes';
    protected $primaryKey = 'idSolicitud';
}
