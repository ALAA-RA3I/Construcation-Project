<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectRepositoryInterface;
use App\Models\Project;

class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function model()
    {
        return Project::class;
    }
}