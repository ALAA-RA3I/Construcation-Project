<?php

namespace App\Domain\Services;

use App\Domain\Services\Contracts\ContractServiceServiceInterface;
use App\Models\PropertyUnitOrder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ContractServiceService implements ContractServiceServiceInterface
{
    /**
     * إنشاء ملف العقد
     */
    public function generateContract(PropertyUnitOrder $order)
    {
        try {
            // إنشاء محتوى العقد
            $contractContent = $this->generateContractContent($order);

            // حفظ العقد كملف PDF
            $contractFileName = 'contracts/contract_' . $order->id . '_' . time() . '.pdf';
            Storage::disk('public')->put($contractFileName, $contractContent);

            // تحديث الطلب
            $order->update([
                'contract_file' => $contractFileName,
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractReady
            ]);

            Log::info('Contract generated', ['order_id' => $order->id, 'file' => $contractFileName]);
            return $contractFileName;
        } catch (\Exception $e) {
            Log::error('Failed to generate contract', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * التحقق من رمز التوقيع
     */
    public function verifySignatureCode(PropertyUnitOrder $order, $signatureCode)
    {
        if ($order->signature_code === $signatureCode) {
            return true;
        }
        return false;
    }

    /**
     * توقيع العميل على العقد
     */
    public function signContractByClient(PropertyUnitOrder $order, $signatureCode)
    {
        try {
            if (!$this->verifySignatureCode($order, $signatureCode)) {
                throw new \Exception('Invalid signature code');
            }

            $order->update([
                'client_signed_at' => now(),
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractSigned
            ]);

            Log::info('Contract signed by client', ['order_id' => $order->id]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to sign contract by client', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * توقيع الشركة على العقد
     */
    public function signContractByCompany(PropertyUnitOrder $order)
    {
        try {
            $order->update([
                'company_signed_at' => now(),
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractFinalized
            ]);

            Log::info('Contract signed by company', ['order_id' => $order->id]);
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to sign contract by company', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * رفع العقد على البلوك تشين
     */
    public function uploadToBlockchain(PropertyUnitOrder $order)
    {
        try {
            // هنا يتم رفع العقد على البلوك تشين
            // يمكن استخدام Web3 أو أي خدمة بلوك تشين أخرى
            $contractHash = $this->generateBlockchainHash($order);

            $order->update([
                'contract_hash' => $contractHash
            ]);

            Log::info('Contract uploaded to blockchain', [
                'order_id' => $order->id,
                'hash' => $contractHash
            ]);

            return $contractHash;
        } catch (\Exception $e) {
            Log::error('Failed to upload contract to blockchain', [
                'order_id' => $order->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * إنشاء محتوى العقد
     */
    private function generateContractContent(PropertyUnitOrder $order)
    {
        $propertyUnit = $order->propertyUnit;
        $client = $order->client;
        $propertyBook = $propertyUnit->propertyBook;

        // هنا يمكن استخدام مكتبة مثل DomPDF لإنشاء PDF
        $content = "
        عقد بيع شقة
        
        الطرف الأول (البائع): الشركة
        الطرف الثاني (المشتري): {$client->first_name} {$client->last_name}
        
        تفاصيل الشقة:
        - رقم الوحدة: {$propertyUnit->unit_number}
        - الطابق: {$propertyUnit->floor}
        - المساحة: {$propertyBook->space} متر مربع
        - السعر: {$propertyBook->price} دولار
        
        تاريخ العقد: " . now()->format('Y-m-d') . "
        
        توقيع الطرف الأول: ________________
        توقيع الطرف الثاني: ________________
        ";

        return $content;
    }

    /**
     * إنشاء hash للبلوك تشين
     */
    private function generateBlockchainHash(PropertyUnitOrder $order)
    {
        $data = [
            'order_id' => $order->id,
            'client_id' => $order->client_id,
            'property_unit_id' => $order->property_unit_id,
            'contract_file' => $order->contract_file,
            'client_signed_at' => $order->client_signed_at,
            'company_signed_at' => $order->company_signed_at,
            'timestamp' => now()->timestamp
        ];

        return hash('sha256', json_encode($data));
    }
}
