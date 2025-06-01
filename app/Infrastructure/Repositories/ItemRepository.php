<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ItemRepositoryInterface;
use App\Models\Item;

class ItemRepository extends BaseRepository implements ItemRepositoryInterface
{
    public function model()
    {
        return Item::class;
    }
}