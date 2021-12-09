<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosDocentes extends Model
{
    use HasFactory;
    protected $table = 'horariosdocentes';
    protected $primaryKey = 'idHorariosDocentes';
    protected $fillable=['Horarios_id','Docentes_id'];
}
