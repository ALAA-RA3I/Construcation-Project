<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectNewsRepositoryInterface;
use App\Models\ProjectNews;

class ProjectNewsRepository extends BaseRepository implements ProjectNewsRepositoryInterface
{
    public function model()
    {
        return ProjectNews::class;
    }
}
