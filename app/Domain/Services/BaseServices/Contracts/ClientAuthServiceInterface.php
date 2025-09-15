<?php

namespace App\Domain\Services\BaseServices\Contracts;

use App\Models\Client;

interface ClientAuthServiceInterface
{
    public function login(array $data): array;
    public function changePassword(array $data,$id);
    public function webLogin(array $credentials): bool;
    public function register(array $data): Client;
    public function webLogout(): void;
}
