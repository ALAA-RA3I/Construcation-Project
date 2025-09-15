<?php

namespace App\Application\DTO\StripeDTO;


class StripeDTO {

    public static function doPaymentRequest(array $data) {
        return [
            // 'card_number' => $data['card_number'],
            // 'exp_month' => $data['exp_month'],
            // 'exp_year' => $data['exp_year'],
            // 'cvc' => $data['cvc'],
            'stripe_token' => $data['stripe_token']
        ];  
    }

}