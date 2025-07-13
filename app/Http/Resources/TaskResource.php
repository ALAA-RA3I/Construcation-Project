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
            'dead_line' => date('Y-m-d', strtotime($this->dead_line)),
            'expected_period_to_complete' => date('d', strtotime($this->dead_line)) - date('d', strtotime($this->start_date)) . ' days',
            'status' => $this->status,
            'description' => $this->description,
            'type_of_task' => $this->type_of_task,
            'note' => $this->note,
            'start_date' => $this->start_date,
            'priority' => $this->priority,
            'actual_date_of_closed' => $this->actual_date_of_closed,
            'stage_id' => $this->stage_id,
            'title' => $this->title,
            // 'employee_assigned' => $this->employee_assigned,
            // 'employee_assigned_name' => $this->employeeAssigned->user,
            'supervisor_id' => $this->supervisor_id,
            // 'stage' => new ProjectStageResource($this->whenLoaded('stage')),
            'employeeAssigned' => $this->whenLoaded('employeeAssigned', function () {
                if (!$this->employeeAssigned) {
                    return null;
                }
                return [
                    'id' => $this->employeeAssigned->id,
                    'name' => optional(optional($this->employeeAssigned->participant)->user)->first_name
                        . ' ' . optional(optional($this->employeeAssigned->participant)->user)->last_name,
                    'email' => optional($this->employeeAssigned->participant)->user->email ?? null,
                ];
            }),
            // 'supervisor' => new ProjectParticipantResource($this->whenLoaded('supervisor')),
            'taskContainer' => TaskContainerResource::collection($this->whenLoaded('taskContainer')),
            'tickets' => TicketResource::collection($this->whenLoaded('ticket')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
