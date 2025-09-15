<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectParticipantRepositoryInterface;
use App\Models\ProjectParticipant;

class ProjectParticipantRepository extends BaseRepository implements ProjectParticipantRepositoryInterface
{
    public function model()
    {
        return ProjectParticipant::class;
    }
}