<?php

namespace App\Http\Resources\ProjectContainer;

use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectWareHouseResource extends JsonResource
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
            'quantity_available' => $this->quantity_available,
            'project_id' => $this->project_id,
            'item' => new ItemResource($this->whenLoaded('items')),
        ];
    }
}
