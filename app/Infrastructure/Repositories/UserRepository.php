<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function model()
    {
        return User::class;
    }
}
