<?php

namespace App\Application\DTO\ProjectContainerDTO;

class ProjectContainerDTO {

public static function fromCreateRequest(array $data, int $project_id)
{
    return [
        'name' => $data['name'] ,
        'category' => $data['category'] ,
        'unit' => $data['unit'] ,
        'expected_quantity' => $data['expected_quantity'] ,
    ];
}

 public static function fromUpdateRequest(array $data) {
    return [
        'expected_quantity' => $data['expected_quantity'] ,
        'items_id' => $data['items_id'] ,
    ];
 }

}
