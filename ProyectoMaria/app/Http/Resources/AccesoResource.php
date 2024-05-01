<?php

namespace App\Http\Resources;

use App\Http\Controllers\AccesoController;
use App\Models\Acceso;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccesoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Acceso' => $this->ID_Acceso,
            'ID_Usuario' => $this->ID_Usuario
            'Perfil' => $this->Perfil,
            'Contraseña' => $this->Contraseña,
            'Fecha' => $this->Fecha
            'Fecha_Expiracion' => $this->Fecha_Expiracion
        ];
    }
}
