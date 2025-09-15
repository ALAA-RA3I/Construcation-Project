<?php

namespace App\Domain\Services\BaseServices\Contracts;

use App\Models\User;

interface AuthServiceInterface
{
    public function login(array $data): array;
    public function getAuthenticatedUserPermissions(User $user): array;

}
