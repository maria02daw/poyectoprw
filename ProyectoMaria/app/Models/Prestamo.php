<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'prestamos';

    protected $primaryKey = 'ID_Prestamo';

    protected $fillable = [
        'ID_Prestamo',
        'ID_Libro',
        'ID_Usuario',
        'Fecha_Prestamo',
        'Fecha_Devolucion_Prevista',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_Usuario');
    }

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'ID_Libro');
    }

    public function devolucion()
    {
        return $this->hasOne(Devolucion::class, 'ID_Prestamo', 'id');
    }
}
