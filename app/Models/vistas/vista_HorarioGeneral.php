<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vista_HorarioGeneral extends Model
{
    use HasFactory;
    protected $table = 'vista_horariogeneral';
    protected $primaryKey = 'idHorarios';
}
