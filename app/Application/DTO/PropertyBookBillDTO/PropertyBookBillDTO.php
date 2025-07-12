<?php

namespace App\Application\DTO\PropertyBookBillDTO;

class PropertyBookBillDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'],
            'amount' => $data['amount'],
            'due_in_months' => $data['due_in_months'] ?? null,
            'type' => $data['type'] ?? 'monthly',
            'description' => $data['description'] ?? null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'property_book_id' => $data['property_book_id'] ?? null,
            'amount' => $data['amount'] ?? null,
            'due_in_months' => $data['due_in_months'] ?? null,
            'type' => $data['type'] ?? null,
            'description' => $data['description'] ?? null,
        ];
    }
}
