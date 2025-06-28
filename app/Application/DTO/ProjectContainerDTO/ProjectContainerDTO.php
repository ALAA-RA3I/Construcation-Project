<?php

namespace App\Application\DTO\ProjectContainerDTO;

class ProjectContainerDTO {

public static function fromCreateRequest(array $data, int $project_id)
{
    return [
        'name' => $data['name'],
        'category' => $data['category'],
        'price' => $data['price'],
        'quantity-available' => $data['quantity-available'] ,
        'expected-quantity' => $data['expected-quantity'] ,
        'consumed-quantity' => $data['consumed-quantity'],
        'required-quantity' => $data['required-quantity'] ,
        'remaining-quantity' => $data['remaining-quantity'],
        'project_id' => $project_id,
    ];
}

 public static function fromUpdateRequest(array $data) {
    return [
        'name' => $data['name'],
        'category' => $data['category'],
        'price' => $data['price'],
        'quantity-available' => $data['quantity-available'],
        'expected-quantity' => $data['expected-quantity'],
        'consumed-quantity' => $data['consumed-quantity'],
        'required-quantity' => $data['required-quantity'],
        'remaining-quantity' => $data['remaining-quantity'],
        'project_id' => $data['project_id'],
        'items_id' => $data['items_id'],
    ];
 }  

}