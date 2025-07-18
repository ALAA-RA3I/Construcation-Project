<?php

namespace App\Domain\Services;

use App\Domain\Services\Contracts\EmailServiceServiceInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\PropertyUnitOrder;

class EmailServiceService implements EmailServiceServiceInterface
{
    /**
     * إرسال إيميل تفعيل الحساب
     */
    public function sendAccountActivationEmail(PropertyUnitOrder $order)
    {
        try {
            Log::info('Starting sendAccountActivationEmail', [
                'order_id' => $order->id,
                'client_id' => $order->client_id,
                'client' => $order->client,
            ]);

            if (!$order->client) {
                Log::error('Order has no client relation', ['order_id' => $order->id]);
                return false;
            }
            if (empty($order->client->email)) {
                Log::error('Client has no email', ['order_id' => $order->id, 'client_id' => $order->client_id]);
                return false;
            }

            $activationToken = \Illuminate\Support\Str::random(64);
            Log::info('Generated activation token', ['order_id' => $order->id, 'activation_token' => $activationToken]);

            // تحديث الطلب برمز التفعيل
            $order->update([
                'activation_token' => $activationToken,
                'activation_token_sent_at' => now(),
            ]);
            Log::info('Order updated with activation token', [
                'order_id' => $order->id,
                'activation_token' => $activationToken
            ]);

            // إرسال الإيميل
            Log::info('Sending account activation email', [
                'to' => $order->client->email,
                'order_id' => $order->id
            ]);
            Mail::send('emails.account-activation', [
                'client' => $order->client,
                'activationToken' => $activationToken,
                'order' => $order
            ], function ($message) use ($order) {
                $message->to($order->client->email)
                    ->subject('تفعيل حسابك - طلب شقة جديد');
            });

            Log::info('Account activation email sent', ['order_id' => $order->id]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send account activation email', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * إرسال إيميل العقد
     */
    public function sendContractEmail(PropertyUnitOrder $order)
    {
        try {
            // تحديث الطلب
            $order->update([
                'contract_sent_at' => now(),
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractReady
            ]);

            // إرسال الإيميل
            Mail::send('emails.contract-ready', [
                'client' => $order->client,
                'order' => $order,
                'propertyUnit' => $order->propertyUnit
            ], function ($message) use ($order) {
                $message->to($order->client->email)
                    ->subject('عقدك جاهز للمراجعة والتوقيع');
            });

            Log::info('Contract email sent', ['order_id' => $order->id]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send contract email', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * إرسال رمز التوقيع السري
     */
    public function sendSignatureCodeEmail(PropertyUnitOrder $order)
    {
        try {
            $signatureCode = \Illuminate\Support\Str::random(6);

            // تحديث الطلب برمز التوقيع
            $order->update([
                'signature_code' => $signatureCode,
                'signature_code_sent_at' => now(),
            ]);

            // إرسال الإيميل
            Mail::send('emails.signature-code', [
                'client' => $order->client,
                'signatureCode' => $signatureCode,
                'order' => $order
            ], function ($message) use ($order) {
                $message->to($order->client->email)
                    ->subject('رمز التوقيع السري - توقيع العقد');
            });

            Log::info('Signature code email sent', ['order_id' => $order->id]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send signature code email', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * إرسال إيميل تأكيد اكتمال العقد
     */
    public function sendContractFinalizedEmail(PropertyUnitOrder $order)
    {
        try {
            Mail::send('emails.contract-finalized', [
                'client' => $order->client,
                'order' => $order,
                'propertyUnit' => $order->propertyUnit
            ], function ($message) use ($order) {
                $message->to($order->client->email)
                    ->subject('تم توقيع العقد بنجاح - مرحباً بك في منزلك الجديد');
            });

            Log::info('Contract finalized email sent', ['order_id' => $order->id]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to send contract finalized email', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
