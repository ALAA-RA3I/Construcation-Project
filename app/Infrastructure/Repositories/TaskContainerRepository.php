<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\TaskContainerRepositoryInterface;
use App\Models\TaskContainer;

class TaskContainerRepository extends BaseRepository implements TaskContainerRepositoryInterface
{
    public function model()
    {
        return TaskContainer::class;
    }
}