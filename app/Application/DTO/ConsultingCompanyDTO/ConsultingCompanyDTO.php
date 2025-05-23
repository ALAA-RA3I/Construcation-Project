<?php

namespace App\Application\DTO\ConsultingCompanyDTO;

class ConsultingCompanyDTO{

    public static function fromCreateRequest(array $data) {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'focal_point_first_name' => $data['focal_point_first_name'],
            'focal_point_last_name' => $data['focal_point_last_name'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'land_line' => $data['land_line'],
            'license_number' => $data['license_number']
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'name' => $data['name'],
            'email' => $data['email'],
            'focal_point_first_name' => $data['focal_point_first_name'],
            'focal_point_last_name' => $data['focal_point_last_name'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'land_line' => $data['land_line'],
            'license_number' => $data['license_number']
        ];
    }

}
