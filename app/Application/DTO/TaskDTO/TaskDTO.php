<?php

namespace App\Application\DTO\TaskDTO;

class TaskDTO {

    public static function fromCreateRequest(array $data) {
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

    public static function fromUpdateRequest(array $data) {
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
}