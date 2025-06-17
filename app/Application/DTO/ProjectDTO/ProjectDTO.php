<?php

namespace App\Application\DTO\ProjectDTO;

class ProjectDTO {

    public static function fromCreateRequest(array $data) {
        return   [
            'title' => $data['title'],
            'project_code' => $data['project_code'],
            'description' => $data['description'],
            'location' => $data['location'],
            'area' => $data['area'],
            'number_of_floor' => $data['number_of_floor'],
            'status_of_sale' => $data['status_of_sale'],
            'expected_date_of_completed' => $data['expected_date_of_completed'],
            'type' => $data['type'],
            'progress_status' => $data['progress_status'],
            'expected_cost' => $data['expected_cost'],
            'owner_id' => $data['owner_id'],
            'consulting_company_id' => $data['consulting_company_id'],
            'project_manager_id' => $data['project_manager_id'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'title' => $data['title'],
            'project_code' => $data['project_code'],
            'description' => $data['description'],
            'location' => $data['location'],
            'area' => $data['area'],
            'number_of_floor' => $data['number_of_floor'],
            'status_of_sale' => $data['status_of_sale'],
            'expected_date_of_completed' => $data['expected_date_of_completed'],
            'type' => $data['type'],
            'progress_status' => $data['progress_status'],
            'expected_cost' => $data['expected_cost'],
            'owner_id' => $data['owner_id'],
        ];
    }
}
