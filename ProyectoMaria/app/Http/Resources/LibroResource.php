<?php

namespace App\Http\Resources;

use App\Http\Controllers\LibroController;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LibroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'ID_Libro' => $this->ID_Libro,
            'Titulo' => $this->Titulo,
            'ID_Autor' => $this->ID_Autor,
            'ID_Editorial' => $this->ID_Editorial,
            'ID_Genero' => $this->ID_Genero,
            'ID_Estado' => $this->ID_Estado,
            'ISBN' => $this->ISBN,
            'Portada' => $this->Portada
        ];
    }
}
