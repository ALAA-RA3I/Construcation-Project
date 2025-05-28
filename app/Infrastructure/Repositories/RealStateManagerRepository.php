<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\RealStateManagerRepositoryInterface;
use App\Models\RealStateManager;

class RealStateManagerRepository extends BaseRepository implements RealStateManagerRepositoryInterface
{
    public function model()
    {
        return RealStateManager::class;
    }
}