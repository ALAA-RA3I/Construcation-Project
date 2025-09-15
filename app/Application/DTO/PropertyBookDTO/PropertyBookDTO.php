<?php

namespace App\Application\DTO\PropertyBookDTO;

class PropertyBookDTO
{

    public static function fromCreateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'],
            'model' => $data['model'],
            'space' => $data['space'],
            'price' => $data['price'],
            'first_payment_amount' => $data['first_payment_amount'],
            'description' => $data['description'] ?? null,
            'payment_period' => $data['payment_period'] ?? null,
            'available_units' => $data['available_units'] ,
            'number_of_rooms' => $data['number_of_rooms'] ?? null,
            'number_of_bathrooms' => $data['number_of_bathrooms'] ?? null,
            'direction' => $data['direction'] ?? null,
            'diagram_image' => isset($data['diagram_image']) ? $data['diagram_image'] : null,
        ];
    }

    public static function fromUpdateRequest(array $data)
    {
        return [
            'project_id' => $data['project_id'] ?? null,
            'model' => $data['model'] ?? null,
            'space' => $data['space'] ?? null,
            'price' => $data['price'] ?? null,
            'first_payment_amount' => $data['first_payment_amount'] ?? null,
            'description' => $data['description'] ?? null,
            'payment_period' => $data['payment_period'] ?? null,
            'available_units' => $data['available_units'] ?? null,
            'number_of_rooms' => $data['number_of_rooms'] ?? null,
            'number_of_bathrooms' => $data['number_of_bathrooms'] ?? null,
            'direction' => $data['direction'] ?? null,
            'diagram_image' => isset($data['diagram_image']) ? $data['diagram_image'] : null,
        ];
    }
}
