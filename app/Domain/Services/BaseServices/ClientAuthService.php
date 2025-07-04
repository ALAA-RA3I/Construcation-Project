<?php

namespace App\Domain\Services\BaseServices;

use App\Domain\Services\BaseServices\Contracts\ClientAuthServiceInterface;
use App\Infrastructure\Repositories\Contracts\ClientRepositoryInterface;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientAuthService implements ClientAuthServiceInterface {

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

        $token = $user->createToken('api_token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];   
    }

    public function changePassword(array $data,$id){
        $client = $this->clientRepo->findOrFail($id);

        $oldPassword = $data['password'];

        if (! Hash::check($oldPassword, $client->password)) {
            throw new \Exception('Old password is incorrect');
        }  

        $updatedData = [
            'password' => Hash::make($data['new_password']),
        ];
        return $this->clientRepo->update($updatedData,$id);
    }
}