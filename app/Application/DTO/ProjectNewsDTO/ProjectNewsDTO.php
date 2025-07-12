<?php

namespace App\Application\DTO\ProjectNewsDTO;

class ProjectNewsDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'],
            'path_file' => isset($data['path_file']) ? $data['path_file'] : null,
            'description' => $data['description'],
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'] ?? null,
            'path_file' => isset($data['path_file']) ? $data['path_file'] : null,
            'description' => $data['description'] ?? null,
        ];
    }
}
