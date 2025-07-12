<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyBookResource extends JsonResource
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
            'project_id' => $this->project_id,
            'model' => $this->model,
            'space' => $this->space,
            'price' => $this->price,
            'description' => $this->description,
            'payment_period' => $this->payment_period,
            'number_of_rooms' => $this->number_of_rooms,
            'number_of_bathrooms' => $this->number_of_bathrooms,
            'direction' => $this->direction,
            'diagram_image' => $this->diagram_image ? asset('storage/' . $this->diagram_image) : null,
            'project' => new ProjectResource($this->whenLoaded('project')),
            // 'units' => PropertyUnitResource::collection($this->whenLoaded('units')),
            // 'bills' => PropertyBookBillResource::collection($this->whenLoaded('bills')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
