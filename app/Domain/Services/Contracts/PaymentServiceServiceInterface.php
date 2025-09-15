<?php

namespace App\Domain\Services\Contracts;

use App\Models\PropertyUnitOrder;

interface PaymentServiceServiceInterface
{
    /**
     * إنشاء Payment Intent للدفع
     */
    public function createPaymentIntent(PropertyUnitOrder $order, $amount);

    /**
     * تأكيد اكتمال الدفع
     */
    public function confirmPayment(PropertyUnitOrder $order, $paymentIntentId);

    /**
     * استرداد Payment Intent
     */
    public function retrievePaymentIntent($paymentIntentId);
}
