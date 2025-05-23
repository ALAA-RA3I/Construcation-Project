<?php

namespace App\Application\DTO\Owner;

class OwnerDTO
{

    public static function fromCreateRequest(array $data)
    {
        return  [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'national_id' => $data['national_id'],
        ];
    }
    public static function fromUpdateRequest(array $data)
    {
        return  [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'national_id' => $data['national_id'],
        ];
    }
}
