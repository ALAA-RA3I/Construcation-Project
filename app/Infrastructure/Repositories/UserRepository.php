<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

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
    public function createUserWithExtraData($userTableData, $extraData, Model $model): User
    {
        $user = User::create($userTableData);
        $modelName = strtolower(class_basename($model));
        $user->$modelName()->create($extraData);
        return $user->load($modelName);
    }

    public function updateUserWithExtraData($userTableData, $extraData, Model $model): User
    {
        $user = User::find($userTableData['id']);
        $user->update($userTableData);
        $modelName = strtolower(class_basename($model));
        $user->$modelName()->update($extraData);
        return $user->load($modelName);
    }
}
