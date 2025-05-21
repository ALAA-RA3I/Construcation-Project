<?php

namespace App\Infrastructure\Repositories;
use App\Infrastructure\Repositories\Contracts\BaseRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

abstract class BaseRepository extends PrettusBaseRepository implements BaseRepositoryInterface
{

}
