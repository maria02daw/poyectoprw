<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    public $timestamps = false;

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Usuario',
        'Nombre',
        'Apellido',
        'Email',

    ];

    public function accesos()
{
    return $this->hasMany(Acceso::class, 'ID_Usuario');
}

  
}
