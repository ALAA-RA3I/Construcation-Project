<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'dead_line' => $this->dead_line,
            'status' => $this->status,
            'status_of_approval' => $this->status_of_approval,
            'type_of_task' => $this->type_of_task,
            'note' => $this->note,
            'start_date' => $this->start_date,
            'priority' => $this->priority,
            'actual_date_of_closed' => $this->actual_date_of_closed,
            'stage_id' => $this->stage_id,
            'employee_assignded' => $this->employee_assignded,
            'supervisor_id' => $this->supervisor_id,
            'stage' => new ProjectStageResource($this->whenLoaded('stage')),
            // 'employeeAssigned' => new ProjectParticipantResource($this->whenLoaded('employeeAssigned')),
            // 'supervisor' => new ProjectParticipantResource($this->whenLoaded('supervisor')),
            'taskContainer' => TaskContainerResource::collection($this->whenLoaded('taskContainer')),
            // 'ticket' => TicketResource::collection($this->whenLoaded('ticket')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
