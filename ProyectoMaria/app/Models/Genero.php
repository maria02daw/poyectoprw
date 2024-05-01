<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $table = 'generos';

    protected $primaryKey = 'ID_Genero';

    protected $fillable = [
        'ID_Genero',
        'Genero',
    ];
}
