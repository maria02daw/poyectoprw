<?php

namespace App\Http\Resources;

use App\Models\Prestamo;
use App\Http\Controllers\PrestamoController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrestamoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Prestamo' => $this->ID_Prestamo,
            'ID_Libro' => $this->ID_Libro,
            'ID_Usuario' => $this->ID_Usuario,
            'Fecha_Prestamo' => $this->Fecha_Prestamo,
            'Fecha_Devolucion_Prevista' => $this->Fecha_Devolucion_Prevista
        ];
    }
}
