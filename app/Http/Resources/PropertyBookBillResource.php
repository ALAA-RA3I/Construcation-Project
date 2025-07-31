<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyBookBillResource extends JsonResource
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
            'amount' => $this->amount,
            'description' => $this->description,
            'property_book' => new PropertyBookResource($this->whenLoaded('propertyBook')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
