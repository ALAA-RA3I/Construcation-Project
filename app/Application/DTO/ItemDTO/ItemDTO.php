<?php

namespace App\Application\DTO\ItemDTO;

class ItemDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'name' => $data['name'],
            'category' => $data['category'],
            'unit' => $data['unit'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'name' => $data['name'],
            'category' => $data['category'],
            'unit' => $data['unit'],
        ];
    }
}
