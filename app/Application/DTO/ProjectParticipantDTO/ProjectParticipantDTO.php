<?php

namespace App\Application\DTO\ProjectParticipantDTO;

class ProjectParticipantDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'project_id' => $data['project_id'],
            'participant_id' => $data['participant_id'],
            'participant_type' => $data['participant_type'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'project_id' => $data['project_id'],
            'participant_id' => $data['participant_id'],
            'participant_type' => $data['participant_type'],
        ];
    }
}