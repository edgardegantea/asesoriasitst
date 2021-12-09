<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistaValidacionDocente extends Model
{
    use HasFactory;
    protected $table = 'validacionasesoriadocente';
    protected $primaryKey = 'idAsesorias';
    
}
