<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectStageRepositoryInterface;
use App\Models\ProjectStage;

class ProjectStageRepository extends BaseRepository implements ProjectStageRepositoryInterface
{
    public function model()
    {
        return ProjectStage::class;
    }
}