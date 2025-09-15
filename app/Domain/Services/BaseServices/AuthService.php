<?php

namespace App\Domain\Services\BaseServices;

use App\Domain\Services\BaseServices\Contracts\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class AuthService implements AuthServiceInterface
{
    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new Exception('Invalid credentials');
        }

        if (! $user->is_active) {
            throw new Exception('Account is inactive. Please contact support.');
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
    public function getAuthenticatedUserPermissions(User $user): array
    {
        return [
            'role' => $user->getRoleNames()->first(),
            'permissions' => $user->getAllPermissions()->pluck('name'),
        ];
    }
}
