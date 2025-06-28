<?php

namespace App\Application\DTO\ProjectContainerDTO;


class ItemIfExistDTO {

    public static function fromCreateRequest(array $data, int $project_id, int $items_id)
    {
        return [
            'quantity-available' => $data['quantity-available'],
            'expected-quantity' => $data['expected-quantity'],
            'consumed-quantity' => $data['consumed-quantity'],
            'required-quantity' => $data['required-quantity'],
            'remaining-quantity' => $data['remaining-quantity'],
            'project_id' => $project_id,
            'items_id' => $items_id,
        ];
    }

}