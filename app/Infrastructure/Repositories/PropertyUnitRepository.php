<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\PropertyUnitRepositoryInterface;
use App\Models\PropertyUnit;

class PropertyUnitRepository extends BaseRepository implements PropertyUnitRepositoryInterface
{
    public function model()
    {
        return PropertyUnit::class;
    }
}
