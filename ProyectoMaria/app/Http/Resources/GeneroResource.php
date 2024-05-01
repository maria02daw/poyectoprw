<?php

namespace App\Http\Resources;

use App\Models\Genero;
use App\Http\Controllers\GeneroController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Genero' => $this->ID_Genero,
            'Nombre' => $this->Nombre
        ];
    }
}
