<?php

namespace App\Application\DTO\ConsultingEngineerDTO;

class ConsultingEngineerDTO
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
            'consulting_company_id'=> $data['consulting_company_id'] ?? null
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
            'consulting_company_id'=> $data['consulting_company_id'] ?? null
        ];
    }
}
