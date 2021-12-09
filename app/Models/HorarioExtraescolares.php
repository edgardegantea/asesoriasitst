<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioExtraescolares extends Model
{
    use HasFactory;
    protected $table = 'horarioextraescolar';
    protected $primaryKey = 'idHorarioExtraescolar';
    protected $fillable=['iddia','HoraInicial','HoraFinal','consideraciones','idExtraescolar','idEstudiantes'];
}
