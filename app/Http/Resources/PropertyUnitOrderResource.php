<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyUnitOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'property_unit_id' => $this->property_unit_id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'identity_file' => $this->identity_file ? asset('storage/' . $this->identity_file) : null,
            'clearance_certificate' => $this->clearance_certificate ? asset('storage/' . $this->clearance_certificate) : null,
            'status' => $this->status,
            'note' => $this->note,
            'property_unit' => new PropertyUnitResource($this->whenLoaded('propertyUnit')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
