<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'devoluciones';

    protected $primaryKey = 'ID_Devolucion';

    protected $fillable = [
        'ID_Devolucion',
        'ID_Prestamo',
        'Fecha_Devolucion',
    ];

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'ID_Prestamo', 'ID_Prestamo');
    }
}
