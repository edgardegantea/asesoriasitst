<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vista_notificacion_vinculacion extends Model
{
    use HasFactory;
    protected $table = 'vista_notificacion_vinculacion';
    protected $primaryKey = 'idNotificaciones';
}
