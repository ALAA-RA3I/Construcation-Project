<?php

namespace App\Application\DTO\Auth;

class LoginDTO
{
    public static function fromLoginRequest(array $data)
    {
        return  [
            'email' => $data['email'],
            'password' => $data['password'],
            'device_token' => $data['device_token'] ?? null
        ];
    }
}
