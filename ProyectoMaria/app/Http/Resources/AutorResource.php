<?php

namespace App\Http\Resources;

use App\Http\Controllers\AutorController;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AutorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Autor' => $this->ID_Autor,
            'Nombre' => $this->Nombre,
            'Apellido' => $this->Apellido,
            'Nacionalidad' => $this->Nacionalidad
        ];
    }
}
