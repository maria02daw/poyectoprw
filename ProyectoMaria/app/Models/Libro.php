<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'libros';

    protected $primaryKey = 'ID_Libro';

    protected $fillable = [
        'Titulo',
        'ID_Autor',
        'ID_Editorial',
        'ID_Genero',
        'ID_Estado',
        'ISBN',
        'Portada',
    ];

    // Relación con la tabla Autores
   public function autor()
     {
       return $this->belongsTo(Autor::class, 'ID_Autor');
   }

   // Relación con la tabla Editoriales
   public function editorial()
   {
       return $this->belongsTo(Editorial::class, 'ID_Editorial');
   }

   // Relación con la tabla Generos
   public function genero()
   {
       return $this->belongsTo(Genero::class, 'ID_Genero');
   }

   // Relación con la tabla Estado
   public function estado()
   {
       return $this->belongsTo(Estado::class, 'ID_Estado');
   }
// Relación con la tabla Prestamos
   public function prestamos() {
    return $this->hasMany(Prestamo::class, 'ID_Libro');
}
}

