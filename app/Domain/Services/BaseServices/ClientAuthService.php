<?php

namespace App\Domain\Services\BaseServices;

use App\Domain\Services\BaseServices\Contracts\ClientAuthServiceInterface;
use App\Infrastructure\Repositories\Contracts\ClientRepositoryInterface;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientAuthService implements ClientAuthServiceInterface
{

    protected $clientRepo;

    public function __construct(ClientRepositoryInterface $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    public function login(array $data): array
    {
        $user = Client::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            throw new Exception('Invalid credentials');
        }

        if (! $user->is_active) {
            throw new Exception('Account is inactive. Please contact support.');
        }
        $user->update([
            'device_token' => $data['device_token']
        ]);
        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }

    public function changePassword(array $data, $id)
    {
        $client = $this->clientRepo->findOrFail($id);

        $oldPassword = $data['password'];

        if (! Hash::check($oldPassword, $client->password)) {
            throw new \Exception('Old password is incorrect');
        }

        $updatedData = [
            'password' => Hash::make($data['new_password']),
        ];
        return $this->clientRepo->update($updatedData, $id);
    }
    public function webLogin(array $credentials): bool
    {
        $client = Client::where('email', $credentials['email'])->first();

        if (!$client || !Hash::check($credentials['password'], $client->password)) {
            return false;
        }

        if (!$client->is_active) {
            throw new \Exception('Account is inactive. Please contact support.');
        }

        Auth::guard('client')->login($client, $credentials['remember'] ?? false);

        return true;
    }

    public function register(array $data): Client

    {
        $data['password'] = Hash::make($data['password']);
        return $this->clientRepo->create($data);
    }

    public function webLogout(): void
    {
        Auth::guard('client')->logout();
    }
}
