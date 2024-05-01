<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Devolucion;
use App\Http\Controllers\DevolucionController;

class DevolucionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Devolucion' => $this->ID_Devolucion,
            'ID_Prestamo' => $this->ID_Prestamo,
            'Fecha_Devolucion' => $this->Fecha_Devolucion
        ];
    }
}
