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
    public function approveOrder($orderId, $status)
    {
        DB::beginTransaction();
        try {
            $order = $this->propertyUnitOrderService->show($orderId);

            if (!$order) {
                return ApiResponse::error('Order not found', 404);
            }
            // if ($order->status !='pending') {
            //     return ApiResponse::error('Order is not in pending status', 400);
            // }
            if ($status == 'approve') {
                // تحديث حالة الطلب
                $order->update(['status' => PropertUnitOrderStatusEnum::Approved]);
            } else {
                // تحديث حالة الطلب
                $order->update(['status' => PropertUnitOrderStatusEnum::Rejected]);
            }

            // إرسال إيميل تفعيل الحساب
            $this->emailService->sendAccountActivationEmail($order);

            DB::commit();
            return ApiResponse::success(
                new PropertyUnitOrderResource($order),
                'Order updated successfully'

            );
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update order status', ['order_id' => $orderId, 'error' => $e->getMessage()]);
            return ApiResponse::error('Failed to update order status', 500);
        }
    }

    /**
     * الخطوة 3: تفعيل حساب العميل
     */
    public function activateAccount(Request $request)
    {
        $token = $request->input('activation_token') ?? $request->query('token');
        if (!$token) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'رمز التفعيل غير موجود.'], 400);
            }
            return view('activation-success', ['success' => false, 'message' => 'رمز التفعيل غير موجود.']);
        }
        try {
            $order = \App\Models\PropertyUnitOrder::where('activation_token', $token)
                ->whereNull('account_activated_at')
                ->first();

            if (!$order) {
                if ($request->expectsJson()) {
                    return response()->json(['success' => false, 'message' => 'رمز التفعيل غير صالح أو منتهي الصلاحية.'], 400);
                }
                return view('activation-success', ['success' => false, 'message' => 'رمز التفعيل غير صالح أو منتهي الصلاحية.']);
            }

            $order->update([
                'account_activated_at' => now()
            ]);

            // إنشاء العقد وتخزينه وربطه بالطلب (بدون تواقيع)
            $contractFilePath = app('App\\Domain\\Services\\Contracts\\ContractServiceServiceInterface')->generateContract($order, false); // false = بدون تواقيع
            if ($contractFilePath) {
                $order->update([
                    'contract_file' => $contractFilePath,
                    'contract_sent_at' => now(),
                ]);
            }

            // إرسال الرمز السري فقط
            $this->emailService->sendSignatureCodeEmail($order);

            $contractUrl = $order->contract_file ? asset('storage/' . $order->contract_file) : null;

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تفعيل حسابك بنجاح! تم إرسال رمز التوقيع إلى بريدك الإلكتروني. يمكنك الآن تسجيل الدخول، مراجعة العقد، وإتمام عملية الدفع.',
                    'contract_url' => $contractUrl
                ]);
            }

            // في الواجهة: لا تعرض رابط العقد
            return view('activation-success', [
                'success' => true,
                'message' => 'تم تفعيل حسابك بنجاح! تم إرسال رمز التوقيع إلى بريدك الإلكتروني.<br>يمكنك الآن تسجيل الدخول، مراجعة العقد، وإتمام عملية الدفع.',
                'contract_url' => null // لا ترسل الرابط للواجهة
            ]);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء تفعيل الحساب.'], 500);
            }
            return view('activation-success', ['success' => false, 'message' => 'حدث خطأ أثناء تفعيل الحساب.']);
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
            // return after payment completed
            // if (!$order->isPaymentCompleted()) {
            //     return ApiResponse::error('Payment must be completed before signing', 400);
            // }

            $clientIp = $request->ip();
            $this->contractService->signContractByClient($order, $request->signature_code, $clientIp);

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

            $result = $this->contractService->signContractByCompany($order);

            // إرسال إيميل تأكيد اكتمال العقد
            $this->emailService->sendContractFinalizedEmail($order);

            return ApiResponse::success([
                'signed_contract_url' => $result['signed_contract_url'],
                'blockchain_link' => $result['blockchain_link'],
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
