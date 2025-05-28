<?php

namespace App\Application\DTO\RealStateDTO;


class RealStateManagerDTO {

    public static function fromCreateRequest(array $data) {
        return [
            'first_name' => $data['first_name'],
            'last_name'=> $data['last_name'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'phone_number'=> $data['phone_number'],
        ];
    }

    public static function fromUpdateRequest(array $data) {
        return [
            'first_name' => $data['first_name'],
            'last_name'=> $data['last_name'],
            'email'=> $data['email'],
            'password'=> $data['password'],
            'phone_number'=> $data['phone_number'],
        ];
    }

}