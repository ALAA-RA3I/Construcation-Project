<?php

namespace App\Http\Resources\ProjectContainer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\ItemResource;

class ProjectContainerResource extends JsonResource
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
            'expected_quantity' => $this->expected_quantity,
            'project_id' => $this->project_id,
            'items_id' => new ItemResource($this->whenLoaded('items')),
        ];
    }
}
