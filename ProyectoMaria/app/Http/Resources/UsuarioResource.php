<?php

namespace App\Http\Resources;

use App\Models\Usuario;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Usuario' => $this->ID_Usuario,
            'Nombre' => $this->Nombre,
            'Apellido' => $this->Apellido,
            'Email' => $this->Email
        ];
    }
}
