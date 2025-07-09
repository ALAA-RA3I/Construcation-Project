<?php

namespace App\Http\Resources\ProjectContainer;

use App\Http\Resources\ItemResource;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectContainerReportsResource extends JsonResource
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
            'expected_quantity' => $this->expected_quantity,
            'consumed_quantity' => $this->consumed_quantity,
            'project_id' => $this->project_id,
            'item' => new ItemResource($this->whenLoaded('items')),
        ];
    }
}
