<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectParticipantResource extends JsonResource
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
            'participant_id' => $this->participant_id,
            'participant_type' => $this->participant_type,
            'project' => $this->whenLoaded('project'),
            'participant' => $this->whenLoaded('participant'),
            'projectFiles' => $this->whenLoaded('projectFiles'),
            'task' => $this->whenLoaded('task'),
            'taskSupervisor' => $this->whenLoaded('taskSupervisor'),
        ];
    }
}