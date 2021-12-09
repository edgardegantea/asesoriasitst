<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraescolares extends Model
{
    use HasFactory;
    protected $table = 'extraescolares';
    protected $primaryKey = 'idExtraescolar';
    protected $fillable=['nombreExtraescolar'];
}
