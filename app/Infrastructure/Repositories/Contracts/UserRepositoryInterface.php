<?php

namespace App\Infrastructure\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function activateUser(User $user): bool;
    public function deactivateUser(User $user): bool;
}
