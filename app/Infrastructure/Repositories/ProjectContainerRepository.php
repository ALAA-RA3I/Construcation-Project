<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectContainerRepositoryInterface;
use App\Models\ProjectContainer;

class ProjectContainerRepository extends BaseRepository implements ProjectContainerRepositoryInterface
{
    public function model()
    {
        return ProjectContainer::class;
    }
}