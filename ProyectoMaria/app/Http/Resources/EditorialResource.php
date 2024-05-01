<?php

namespace App\Http\Resources;

use App\Models\Editorial;
use App\Http\Controllers\EditorialController;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EditorialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ID_Editorial' => $this->ID_Editorial,
            'Nombre' => $this->Nombre
        ];
    }
}
