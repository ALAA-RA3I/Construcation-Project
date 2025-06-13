<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectManagerRepositoryInterface;
use App\Models\ProjectManager;

class ProjectManagerRepository extends BaseRepository implements ProjectManagerRepositoryInterface
{
    public function model()
    {
        return ProjectManager::class;
    }
}