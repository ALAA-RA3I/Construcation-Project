<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\PropertyUnitOrderRepositoryInterface;
use App\Models\PropertyUnitOrder;

class PropertyUnitOrderRepository extends BaseRepository implements PropertyUnitOrderRepositoryInterface
{
    public function model()
    {
        return PropertyUnitOrder::class;
    }
}
