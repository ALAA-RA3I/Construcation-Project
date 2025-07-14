<?php

namespace App\Application\DTO\PropertyUnitOrderDTO;

class PropertyUnitOrderDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'property_unit_id' => $data['property_unit_id'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'],
            'identity_file' => isset($data['identity_file']) ? $data['identity_file'] : null,
            'clearance_certificate' => isset($data['clearance_certificate']) ? $data['clearance_certificate'] : null,
            'status' => $data['status'] ?? null,
            'note' => $data['note'] ?? null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'property_unit_id' => $data['property_unit_id'] ?? null,
            'first_name' => $data['first_name'] ?? null,
            'middle_name' => $data['middle_name'] ?? null,
            'last_name' => $data['last_name'] ?? null,
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'identity_file' => isset($data['identity_file']) ? $data['identity_file'] : null,
            'clearance_certificate' => isset($data['clearance_certificate']) ? $data['clearance_certificate'] : null,
            'status' => $data['status'] ?? null,
            'note' => $data['note'] ?? null,
        ];
    }
}
