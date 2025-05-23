<?php

namespace App\Application\DTO\ActivationDTO;

class ActivationDTO
{

    public static function fromActivationRequest(array $data)
    {
        return  [
            'user_id' => $data['user_id'],
        ];
    }
}
