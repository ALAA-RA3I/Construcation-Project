<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'property_book_id' => $this->property_book_id,
            'unit_number' => $this->unit_number,
            'floor' => $this->floor,
            'client_id' => $this->client_id,
            'property_book' => new PropertyBookResource($this->whenLoaded('propertyBook')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
