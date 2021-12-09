<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosAlumnos extends Model
{
    use HasFactory;
    protected $table = 'horariosalumnos';
    protected $primaryKey = 'idHorariosAlumnos';
    protected $fillable=['idHorarios','idEstudiantes','updated_at','created_at'];
}
