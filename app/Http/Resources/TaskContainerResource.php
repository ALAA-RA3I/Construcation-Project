<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskContainerResource extends JsonResource
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
            'quantity' => $this->quantity,
            'task' => new TaskResource($this->whenLoaded('task')),
            'item' => new ItemResource($this->whenLoaded('item')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}