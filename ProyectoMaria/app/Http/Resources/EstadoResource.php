<?php

namespace App\Http\Resources;

use App\Http\Controllers\EstadoController;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Estado' => $this->ID_Estado,
            'Nombre' => $this->Nombre
        ];
    }
}
