<?php

namespace App\Application\DTO\ProjectSalesDetailsDTO;

class ProjectSalesDetailsDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'],
            'main_title' => $data['main_title'] ?? null,
            'marketing_description' => $data['marketing_description'] ?? null,
            'location_link' => $data['location_link'] ?? null,
            'address' => $data['address'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'main_image' => $data['main_image'] ?? null,
            'diagram_image' => $data['diagram_image'] ?? null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'] ?? null,
            'main_title' => $data['main_title'] ?? null,
            'marketing_description' => $data['marketing_description'] ?? null,
            'location_link' => $data['location_link'] ?? null,
            'address' => $data['address'] ?? null,
            'video_url' => $data['video_url'] ?? null,
            'main_image' => $data['main_image'] ?? null,
            'diagram_image' => $data['diagram_image'] ?? null,
        ];
    }
}
