<?php

namespace App\Application\DTO\Auth;

class LoginDTO
{
    public static function fromLoginRequest(array $data)
    {
        return  [
            'email' => $data['email'],
            'password' => $data['password']
        ];
    }
}
