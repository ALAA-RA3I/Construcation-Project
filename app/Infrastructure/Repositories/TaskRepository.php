<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\TaskRepositoryInterface;
use App\Models\Task;

class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    public function model()
    {
        return Task::class;
    }
}