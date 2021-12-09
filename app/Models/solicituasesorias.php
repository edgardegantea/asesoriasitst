<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicituasesorias extends Model
{
    use HasFactory;
    protected $table = 'solicituasesorias';
    protected $primaryKey = 'idSolicituAsesorias';
    protected $fillable=['justificacion','estado','idEstudiantes','idMateria'];
}
