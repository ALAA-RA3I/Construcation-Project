<?php

namespace App\Application\DTO\ClientsDTO;


class ChangePasswordDTO {

    public static function fromChangeRequest(array $data) {
        return [
            'password' => $data['password'],
            'new_password' =>$data['new_password']
        ];
    }
} 