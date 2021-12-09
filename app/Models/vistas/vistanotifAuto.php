<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistanotifAuto extends Model
{
    use HasFactory;
    protected $table = 'vista_notificacion_alumos';
    protected $primaryKey = 'idnotif';

}
