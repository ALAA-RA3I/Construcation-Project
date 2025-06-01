<?php

namespace App\Application\DTO\TicketDTO;

class TicketDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'description' => $data['description'],
            'status' => $data['status'],
            'task_id' => $data['task_id'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'description' => $data['description'],
            'status' => $data['status'],
            'task_id' => $data['task_id'],
        ];
    }
}