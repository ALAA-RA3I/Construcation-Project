<?php

namespace App\Infrastructure\Repositories;

 use App\Infrastructure\Repositories\Contracts\OwnerRepositoryInterface;
use App\Models\Owner;

class OwnerRepository extends BaseRepository implements OwnerRepositoryInterface
{
    public function model()
    {
        return Owner::class;
    }
}