<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'title' => $this->title,
            'project_code' => $this->project_code,
            'description' => $this->description,
            'location' => $this->location,
            'area' => $this->area,
            'number_of_floor' => $this->number_of_floor,
            'status_of_sale' => $this->status_of_sale,
            'expected_date_of_completed' => $this->expected_date_of_completed,
            'type' => $this->type,
            'progress_status' => $this->progress_status,
            'expected_cost' => $this->expected_cost,
            'owner' => new OwnerResource($this->whenLoaded('owners')),
            'participants' => ProjectParticipantResource::collection($this->whenLoaded('projectParticipant')),
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at
        ];
    }
}