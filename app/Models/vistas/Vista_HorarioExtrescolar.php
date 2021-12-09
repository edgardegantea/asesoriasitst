<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vista_HorarioExtrescolar extends Model
{
    use HasFactory;
    protected $table = 'vista_horarioextraescolar';
    protected $primaryKey = 'idHorarioExtraescolar';
}
