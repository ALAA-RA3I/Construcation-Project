<?php

namespace App\Domain\Services;

use App\Domain\Services\Contracts\PaymentServiceServiceInterface;
use App\Models\PropertyUnitOrder;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentServiceService implements PaymentServiceServiceInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * إنشاء Payment Intent للدفع
     */
    public function createPaymentIntent(PropertyUnitOrder $order, $amount)
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount * 100, // Stripe يتعامل بالسنت
                'currency' => 'usd',
                'metadata' => [
                    'order_id' => $order->id,
                    'client_id' => $order->client_id,
                    'property_unit_id' => $order->property_unit_id
                ]
            ]);

            // تحديث الطلب
            $order->update([
                'payment_intent_id' => $paymentIntent->id,
                'payment_amount' => $amount,
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::PaymentPending
            ]);

            Log::info('Payment intent created', [
                'order_id' => $order->id,
                'payment_intent_id' => $paymentIntent->id
            ]);

            return $paymentIntent;
        } catch (\Exception $e) {
            Log::error('Failed to create payment intent', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * تأكيد اكتمال الدفع
     */
    public function confirmPayment(PropertyUnitOrder $order, $paymentIntentId)
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'succeeded') {
                $order->update([
                    'payment_completed_at' => now(),
                    'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::PaymentCompleted
                ]);

                Log::info('Payment confirmed', [
                    'order_id' => $order->id,
                    'payment_intent_id' => $paymentIntentId
                ]);

                return true;
            }

            return false;
        } catch (\Exception $e) {
            Log::error('Failed to confirm payment', [
                'order_id' => $order->id,
                'payment_intent_id' => $paymentIntentId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * استرداد Payment Intent
     */
    public function retrievePaymentIntent($paymentIntentId)
    {
        try {
            return PaymentIntent::retrieve($paymentIntentId);
        } catch (\Exception $e) {
            Log::error('Failed to retrieve payment intent', [
                'payment_intent_id' => $paymentIntentId,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
