<?php

namespace App\Http\Resources;

 use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OwnerResource extends JsonResource
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
            'address' => $this->address,
            'national_id' => $this->national_id,

            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
