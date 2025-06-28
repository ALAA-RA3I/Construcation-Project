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
            'quantity-available' => $this->getAttribute('quantity-available'),
            'expected-quantity' => $this->getAttribute('expected-quantity'),
            'consumed-quantity' => $this->getAttribute('consumed-quantity'),
            'required-quantity' => $this->getAttribute('required-quantity'),
            'remaining-quantity' => $this->getAttribute('remaining-quantity'),
            'project_id' => new ProjectResource($this->whenLoaded('project')),
            'items_id' => new ItemResource($this->whenLoaded('items')),
        ];
    }
}
