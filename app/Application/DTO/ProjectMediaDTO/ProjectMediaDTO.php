<?php

namespace App\Application\DTO\ProjectMediaDTO;

class ProjectMediaDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'],
            'path_file' => isset($data['path_file']) ? $data['path_file'] : null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'] ?? null,
            'path_file' => isset($data['path_file']) ? $data['path_file'] : null,
        ];
    }
}
