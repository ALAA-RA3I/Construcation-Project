<?php

namespace App\Domain\Services\BaseServices\Contracts;

interface AuthServiceInterface
{
    public function login(array $data): array;
}
