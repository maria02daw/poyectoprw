<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    protected $table = 'editoriales';

    protected $primaryKey = 'ID_Editorial';

    protected $fillable = [
        'ID_Editorial',
        'nombre',
    ];
}
