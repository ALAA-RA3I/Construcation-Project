<?php

namespace App\Application\DTO\ProjectParticipantDTO;

use App\Domain\Enums\ProjectRoleEnum;

class ProjectParticipantDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'project_id' => $data['project_id'],
            'participant_id' => $data['participant_id'],
            'participant_type' => $data['participant_type'],
            'role' => ProjectRoleEnum::Engineer
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'project_id' => $data['project_id'],
            'participant_id' => $data['participant_id'],
            'participant_type' => $data['participant_type'],
            'role' => ProjectRoleEnum::Engineer
        ];
    }
}
