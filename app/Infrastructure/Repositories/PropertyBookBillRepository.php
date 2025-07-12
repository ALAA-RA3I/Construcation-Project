<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\PropertyBookBillRepositoryInterface;
use App\Models\PropertyBookBill;

class PropertyBookBillRepository extends BaseRepository implements PropertyBookBillRepositoryInterface
{
    public function model()
    {
        return PropertyBookBill::class;
    }
}
