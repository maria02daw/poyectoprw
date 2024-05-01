<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    use HasFactory;

    protected $table = 'acceso_usuarios';

    public $timestamps = false;

    protected $primaryKey = 'ID_Acceso';
    protected $fillable = [
        'ID_Usuario',
        'Perfil',
        'Contraseña',
        'Token',
        'Fecha',
        'Fecha_Expiracion',
    ];


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario', 'ID_Usuario');
    }
}
