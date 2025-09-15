<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\PropertyBookRepositoryInterface;
use App\Models\PropertyBook;

class PropertyBookRepository extends BaseRepository implements PropertyBookRepositoryInterface
{
    public function model()
    {
        return PropertyBook::class;
    }
}
