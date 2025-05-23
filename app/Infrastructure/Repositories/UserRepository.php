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
    public function activateUser(User $user): bool
    {
        $user->is_active = true;
        return $user->save();
    }

    public function deactivateUser(User $user): bool
    {
        $user->is_active = false;
        return  $user->save();

    }
}
