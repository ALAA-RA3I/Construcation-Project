<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\EngineerRepositoryInterface;
use App\Models\Engineer;

class EngineerRepository extends BaseRepository implements EngineerRepositoryInterface
{
    public function model()
    {
        return Engineer::class;
    }
}