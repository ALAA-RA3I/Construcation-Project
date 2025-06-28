<?php

namespace App\Application\DTO\TicketDTO;

class TicketDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'description' => $data['description'],
            'status' => $data['status'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'description' => $data['description'],
            'status' => $data['status'],
        ];
    }
}