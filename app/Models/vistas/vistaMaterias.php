<?php

namespace App\Models\vistas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vistaMaterias extends Model
{
    use HasFactory;
    protected $table = 'vistamaterias';
    protected $primaryKey = 'id';
}
