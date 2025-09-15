<?php

namespace App\Application\DTO\PropertyBookBillDTO;

class PropertyBookBillDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'],
            'amount' => $data['amount'],
            'description' => $data['description'] ?? null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'] ?? null,
            'amount' => $data['amount'] ?? null,
            'description' => $data['description'] ?? null,
        ];
    }
}
