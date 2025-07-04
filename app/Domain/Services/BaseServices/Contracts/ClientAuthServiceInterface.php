<?php

namespace App\Domain\Services\BaseServices\Contracts;

interface ClientAuthServiceInterface
{
    public function login(array $data): array;
    public function changePassword(array $data,$id);
}
