<?php

namespace App\Infrastructure\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function activateUser(User $user): bool;
    public function deactivateUser(User $user): bool;
    public function createUserWithExtraData( $userTableData, $extraData ,Model $model): User;
    public function updateUserWithExtraData( $userTableData, $extraData ,Model $model): User;

}
