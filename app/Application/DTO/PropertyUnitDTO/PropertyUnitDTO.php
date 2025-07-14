<?php

namespace App\Application\DTO\PropertyUnitDTO;

class PropertyUnitDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'],
            'unit_number' => $data['unit_number'],
            'floor' => $data['floor'] ?? null,
            // 'client_id' => $data['client_id'],
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'] ?? null,
            'unit_number' => $data['unit_number'] ?? null,
            'floor' => $data['floor'] ?? null,
            // 'client_id' => $data['client_id'] ?? null,
        ];
    }
}
