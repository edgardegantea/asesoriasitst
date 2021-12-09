<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistaValidaciones extends Model
{
    use HasFactory;
    protected $table = 'vista_validaciones';
    protected $primaryKey = 'idAsesorias';
}
