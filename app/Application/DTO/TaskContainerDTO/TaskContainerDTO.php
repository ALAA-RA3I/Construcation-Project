<?php

namespace App\Application\DTO\TaskContainerDTO;

class TaskContainerDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'quantity' => $data['quantity'],
            'task_id' => $data['task_id'],
            'items_id' => $data['items_id'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'quantity' => $data['quantity'],
            'task_id' => $data['task_id'],
            'items_id' => $data['items_id'],
        ];
    }
}