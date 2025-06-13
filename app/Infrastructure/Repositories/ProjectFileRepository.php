<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectFileRepositoryInterface;
use App\Models\ProjectFile;

class ProjectFileRepository extends BaseRepository implements ProjectFileRepositoryInterface
{
    public function model()
    {
        return ProjectFile::class;
    }
}