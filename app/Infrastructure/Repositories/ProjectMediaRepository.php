<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectMediaRepositoryInterface;
use App\Models\ProjectMedia;

class ProjectMediaRepository extends BaseRepository implements ProjectMediaRepositoryInterface
{
    public function model()
    {
        return ProjectMedia::class;
    }
}
