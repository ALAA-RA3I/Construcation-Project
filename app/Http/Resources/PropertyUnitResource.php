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
            'first_payment_date'=> $this->first_payment_date,
            'client' =>  new ClientResource($this->whenLoaded('client')),
            'client_id' => $this->client_id,
        ];
    }
}
