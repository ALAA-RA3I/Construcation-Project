<?php

namespace App\Application\DTO\ProjectContainerDTO;


class ItemIfExistDTO {

    public static function fromCreateRequest(array $data, int $project_id)
    {
        return [
            'expected_quantity' => $data['expected_quantity'],
            'project_id' => $project_id,
            'items_id' => $data['items_id'],
        ];
    }

}
