<?php

namespace App\Application\DTO\ProjectStageDTO;

class ProjectStageDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'name' => $data['name'],
            'description' => $data['description'],
            'expected_closed_date' => $data['expected_closed_date'],
            'project_id' => $data['project_id'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'name' => $data['name'],
            'description' => $data['description'],
            'expected_closed_date' => $data['expected_closed_date'],
            'project_id' => $data['project_id'],
        ];
    }
}