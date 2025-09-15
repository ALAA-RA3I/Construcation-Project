<?php

namespace App\Application\DTO\PropertyUnitOrderDTO;

use App\Domain\Enums\PropertUnitOrderStatusEnum;

class PropertyUnitOrderDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'],
            'client_id' => $data['client_id'],
            'identity_file' => isset($data['identity_file']) ? $data['identity_file'] : null,
             'status' => PropertUnitOrderStatusEnum::Pending,
            'note' => $data['note'] ?? null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'] ?? null,
            'client_id' => $data['client_id'] ?? null,
            // 'first_name' => $data['first_name'] ?? null,
            // 'middle_name' => $data['middle_name'] ?? null,
            // 'last_name' => $data['last_name'] ?? null,
            // 'email' => $data['email'] ?? null,
            // 'phone' => $data['phone'] ?? null,
            'identity_file' => isset($data['identity_file']) ? $data['identity_file'] : null,
            // 'status' => $data['status'] ?? null,
            'note' => $data['note'] ?? null,
        ];
    }
}
