<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    use HasFactory;
    protected $table = 'notificaciones';

    protected $primaryKey = 'idNotificaciones';
    protected $fillable=['tipo', 'created_at', 'updated_at', 'idSolicituAsesorias'];
}
