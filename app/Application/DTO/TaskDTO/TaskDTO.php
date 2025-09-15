<?php

namespace App\Application\DTO\TaskDTO;

use App\Models\Task;

class TaskDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'dead_line' => $data['dead_line'],
            'status' => $data['status'],
            'status_of_approval' => $data['status_of_approval'],
            'type_of_task' => $data['type_of_task'],
            'note' => $data['note'],
            'actual_date_of_closed' => $data['actual_date_of_closed'] ?? null,
            'stage_id' => $data['stage_id'],
            'employee_assigned' => $data['employee_assigned'],
            'start_date' => $data['start_date'],
            'priority' => $data['priority'],
            'description' => $data['description'] ?? null,
            'title' => $data['title'],
            'supervisor_id' => $data['supervisor_id'],
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'dead_line' => $data['dead_line'],
            'status' => $data['status'],
            'status_of_approval' => $data['status_of_approval'],
            'type_of_task' => $data['type_of_task'],
            'note' => $data['note'],
            'actual_date_of_closed' => $data['actual_date_of_closed'] ?? null,
            'stage_id' => $data['stage_id'],
            'employee_assigned' => $data['employee_assigned'],
            'supervisor_id' => $data['supervisor_id'],
        ];
    }
    public static function fromChangeStatusRequest(array $data, Task $task): array
    {
        return [
            'task' => $task,
            'status' => $data['status'],
            'ticket_description' => $data['ticket_description'] ?? null,
            'user' => auth()->user(), // مهم لتحديد الدور
        ];
    }
}
