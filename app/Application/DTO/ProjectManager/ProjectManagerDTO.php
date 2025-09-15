<?php

namespace App\Application\DTO\ProjectManager;

class ProjectManagerDTO
{
    public static function fromCreateRequest(array $data)
    {
        return  [
            'first_name' => $data['first_name'],
            'last_name'=> $data['last_name'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'phone_number'=> $data['phone_number'],
            'bio'=> $data['bio'],
            'years_of_experience'=> $data['years_of_experience'] ?? null
        ];
    }
    public static function fromUpdateRequest(array $data)
    {
        return  [
            'first_name' => $data['first_name'],
            'last_name'=> $data['last_name'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'phone_number'=> $data['phone_number'],
            'bio'=> $data['bio'],
            'years_of_experience'=> $data['years_of_experience'] ?? null
        ];
    }
}
