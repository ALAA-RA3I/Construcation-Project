<?php

namespace App\Application\DTO\Engineer;

class EngineerDTO
{

    public static function fromCreateRequest(array $data)
    {
        return  [
            'first_name' => $data['first_name'],
            'last_name'=> $data['last_name'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'phone_number'=> $data['phone_number'],
            'engineer_specialization_id'=> $data['engineer_specialization_id'],
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
            'engineer_specialization_id'=> $data['engineer_specialization_id'],
            'years_of_experience'=> $data['years_of_experience'] ?? null
        ];
    }
}
