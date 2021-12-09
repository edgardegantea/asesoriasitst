<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;
    protected $table = 'horarios';
    protected $primaryKey = 'idHorarios';
    protected $fillable=['iddia','HoraInicial','HoraFinal','idMateria','idModalidades', 'idSemestres','id_docente','created_at','updated_at'];
}
