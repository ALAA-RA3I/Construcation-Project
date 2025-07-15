<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\Contracts\ContractServiceServiceInterface;
use App\Domain\Services\Contracts\EmailServiceServiceInterface;
use App\Domain\Services\Contracts\PaymentServiceServiceInterface;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Domain\Enums\PropertUnitOrderStatusEnum;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyUnitOrderResource;
use App\Models\PropertyUnitOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContractFlowController extends Controller
{
    protected $propertyUnitOrderService;
    protected $emailService;
    protected $paymentService;
    protected $contractService;

    public function __construct(
        PropertyUnitOrderServiceInterface $propertyUnitOrderService,
        EmailServiceServiceInterface $emailService,
        PaymentServiceServiceInterface $paymentService,
        ContractServiceServiceInterface $contractService
    ) {
        $this->propertyUnitOrderService = $propertyUnitOrderService;
        $this->emailService = $emailService;
        $this->paymentService = $paymentService;
        $this->contractService = $contractService;
    }

    /**
     * الخطوة 1: العميل يسجل الدخول ويقدم طلب شقة
     */
    public function createOrder(Request $request)
    {
        // يتم التعامل معها في PropertyUnitOrderController
        return response()->json(['message' => 'Use PropertyUnitOrderController@create']);
    }

    /**
     * الخطوة 2: مدير يوافق على الطلب
     */
    public function approveOrder($orderId)
    {
        DB::beginTransaction();
        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            if (!$order->isStatus(PropertUnitOrderStatusEnum::Pending)) {
                return ApiResponse::error('Order is not in pending status', 400);
            }

            // تحديث حالة الطلب
            $order->update(['status' => PropertUnitOrderStatusEnum::Approved]);

            // إرسال إيميل تفعيل الحساب
            $this->emailService->sendAccountActivationEmail($order);

            DB::commit();
            return ApiResponse::success(
                new PropertyUnitOrderResource($order),
                'Order approved and activation email sent'
            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to approve order', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to approve order', 500);
        }
    }

    /**
     * الخطوة 3: تفعيل حساب العميل
     */
    public function activateAccount(Request $request)
    {
        $request->validate([
            'activation_token' => 'required|string'
        ]);

        try {
            $order = PropertyUnitOrder::where('activation_token', $request->activation_token)
                ->whereNull('account_activated_at')
                ->first();

            if (!$order) {
                return ApiResponse::error('Invalid or expired activation token', 400);
            }

            $order->update([
                'account_activated_at' => now()
            ]);

            // إرسال إيميل العقد
            $this->emailService->sendContractEmail($order);

            return ApiResponse::success(
                new PropertyUnitOrderResource($order),
                'Account activated and contract email sent'
            );
        } catch (\Exception $e) {
            Log::error('Failed to activate account', ['error' => $e->getMessage()]);
            return ApiResponse::error('Failed to activate account', 500);
        }
    }

    /**
     * الخطوة 4: إنشاء العقد
     */
    public function generateContract($orderId)
    {
        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            if (!$order->isStatus(PropertUnitOrderStatusEnum::ContractReady)) {
                return ApiResponse::error('Order is not ready for contract generation', 400);
            }

            $contractFile = $this->contractService->generateContract($order);

            return ApiResponse::success([
                'contract_file' => $contractFile,
                'order' => new PropertyUnitOrderResource($order)
            ], 'Contract generated successfully');
        } catch (\Exception $e) {
            Log::error('Failed to generate contract', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to generate contract', 500);
        }
    }

    /**
     * الخطوة 5: إرسال رمز التوقيع
     */
    public function sendSignatureCode($orderId)
    {
        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            if (!$order->isStatus(PropertUnitOrderStatusEnum::ContractReady)) {
                return ApiResponse::error('Order is not ready for signature', 400);
            }

            $this->emailService->sendSignatureCodeEmail($order);

            return ApiResponse::success(
                new PropertyUnitOrderResource($order),
                'Signature code sent successfully'
            );
        } catch (\Exception $e) {
            Log::error('Failed to send signature code', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to send signature code', 500);
        }
    }

    /**
     * الخطوة 6: إنشاء Payment Intent
     */
    public function createPaymentIntent(Request $request, $orderId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0'
        ]);

        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            $paymentIntent = $this->paymentService->createPaymentIntent($order, $request->amount);

            return ApiResponse::success([
                'payment_intent_id' => $paymentIntent->id,
                'client_secret' => $paymentIntent->client_secret,
                'order' => new PropertyUnitOrderResource($order)
            ], 'Payment intent created successfully');
        } catch (\Exception $e) {
            Log::error('Failed to create payment intent', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to create payment intent', 500);
        }
    }

    /**
     * الخطوة 7: تأكيد الدفع
     */
    public function confirmPayment(Request $request, $orderId)
    {
        $request->validate([
            'payment_intent_id' => 'required|string'
        ]);

        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            $paymentConfirmed = $this->paymentService->confirmPayment($order, $request->payment_intent_id);

            if (!$paymentConfirmed) {
                return ApiResponse::error('Payment confirmation failed', 400);
            }

            return ApiResponse::success(
                new PropertyUnitOrderResource($order),
                'Payment confirmed successfully'
            );
        } catch (\Exception $e) {
            Log::error('Failed to confirm payment', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to confirm payment', 500);
        }
    }

    /**
     * الخطوة 8: توقيع العميل على العقد
     */
    public function signContractByClient(Request $request, $orderId)
    {
        $request->validate([
            'signature_code' => 'required|string'
        ]);

        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            if (!$order->isPaymentCompleted()) {
                return ApiResponse::error('Payment must be completed before signing', 400);
            }

            $this->contractService->signContractByClient($order, $request->signature_code);

            return ApiResponse::success(
                new PropertyUnitOrderResource($order),
                'Contract signed by client successfully'
            );
        } catch (\Exception $e) {
            Log::error('Failed to sign contract by client', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to sign contract by client', 500);
        }
    }

    /**
     * الخطوة 9: توقيع الشركة على العقد
     */
    public function signContractByCompany($orderId)
    {
        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            if (!$order->isClientSigned()) {
                return ApiResponse::error('Client must sign first', 400);
            }

            $this->contractService->signContractByCompany($order);

            // رفع العقد على البلوك تشين
            $contractHash = $this->contractService->uploadToBlockchain($order);

            // إرسال إيميل تأكيد اكتمال العقد
            $this->emailService->sendContractFinalizedEmail($order);

            return ApiResponse::success([
                'contract_hash' => $contractHash,
                'order' => new PropertyUnitOrderResource($order)
            ], 'Contract signed by company and uploaded to blockchain');
        } catch (\Exception $e) {
            Log::error('Failed to sign contract by company', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to sign contract by company', 500);
        }
    }

    /**
     * الحصول على حالة الطلب
     */
    public function getOrderStatus($orderId)
    {
        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }

            return ApiResponse::success([
                'status' => $order->status,
                'is_client_signed' => $order->isClientSigned(),
                'is_company_signed' => $order->isCompanySigned(),
                'is_payment_completed' => $order->isPaymentCompleted(),
                'contract_file_url' => $order->contract_file_url,
                'contract_hash' => $order->contract_hash,
                'order' => new PropertyUnitOrderResource($order)
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to get order status', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to get order status', 500);
        }
    }
}
