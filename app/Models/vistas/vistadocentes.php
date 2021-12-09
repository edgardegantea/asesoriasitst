<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistadocentes extends Model
{
    use HasFactory;
    protected $table = 'vistadocentes';
    protected $primaryKey = 'id';
}
