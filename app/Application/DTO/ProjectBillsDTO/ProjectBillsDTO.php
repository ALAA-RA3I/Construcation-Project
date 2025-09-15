<?php

namespace App\Application\DTO\ProjectBillsDTO;

class ProjectBillsDTO
{
    public static function fromCreateRequest(array $data) {
        return [
            'project_id' => $data['project_id'],
            'description' => $data['description'],
            'date_of_payment' => $data['date_of_payment'],
            'details' => $data['details'] ?? [],
        ];
    }
}
