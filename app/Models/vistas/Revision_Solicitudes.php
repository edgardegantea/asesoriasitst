<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision_Solicitudes extends Model
{
    use HasFactory;
    protected $table = 'revision_solicitudes';
    protected $primaryKey = 'idSolicitud';
}
