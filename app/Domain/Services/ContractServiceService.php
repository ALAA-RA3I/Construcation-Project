<?php

namespace App\Domain\Services;

use App\Domain\Services\Contracts\ContractServiceServiceInterface;
use App\Domain\Services\IPFSServiceService;
use App\Models\PropertyUnitOrder;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContractServiceService implements ContractServiceServiceInterface
{
    protected $ipfsService;

    public function __construct(IPFSServiceService $ipfsService = null)
    {
        $this->ipfsService = $ipfsService ?? app(IPFSServiceService::class);
    }

    /**
     * إنشاء ملف العقد
     */
    public function generateContract(PropertyUnitOrder $order, $withSignatures = false)
    {
        try {
            // استخدم Blade أو HTML كقالب
            $pdf = Pdf::loadView('contracts.pdf', [
                'order' => $order,
                'withSignatures' => $withSignatures,
                'date' => now()->format('Y-m-d'),
                'client' => $order->client,
                // 'propertyUnit' => $order->propertyUnit,
                'propertyBook' => $order->propertyBook,
                'secret_code' => $order->signature_code,

            ]);
            $contractFileName = 'contracts/contract_' . $order->id . '_' . time() . '.pdf';
            Storage::disk('public')->put($contractFileName, $pdf->output());

            // تحديث الطلب
            $order->update([
                'contract_file' => $contractFileName,
                // 'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractReady
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
    public function signContractByClient(PropertyUnitOrder $order, $signatureCode, $clientIp = null, $request = null)
    {
        try {
            Log::info('Start client contract signing', [
                'order_id' => $order->id,
                'signatureCode' => $signatureCode,
                'client_ip' => $clientIp,
            ]);

            if (!$this->verifySignatureCode($order, $signatureCode)) {
                Log::warning('Invalid signature code', ['order_id' => $order->id]);
                throw new \Exception('Invalid signature code');
            }

            $order->update([
                'client_signed_at' => now(),
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractSigned
            ]);

            // معلومات إضافية من الريكوست (إن وجدت)
            $clientInfo = [
                'user_agent' => $request ? $request->header('User-Agent') : null,
                'client_ip' => $clientIp,
                'client_email' => $order->client->email ?? null,
                'client_phone' => $order->client->phone ?? null,
                'client_identity' => $order->client->identity_number ?? null,
                'client_full_name' => $order->client->first_name . ' ' . $order->client->last_name,
            ];

            // توليد PDF أولي بدون رابط بلوك تشين
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', [
                'order' => $order,
                'withSignatures' => true,
                'date' => now()->format('Y-m-d'),
                'client' => $order->client,
                'propertyUnit' => $order->propertyUnit,
                'propertyBook' => $order->propertyUnit ? $order->propertyUnit->propertyBook : null,
                'secret_code' => $order->signature_code,
                'client_ip' => $clientIp,
                'blockchain_link' => null,
                'clientInfo' => $clientInfo,
            ]);
            $signedFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($signedFileName, $pdf->output());
            $order->update(['contract_file' => $signedFileName]);

            Log::info('PDF generated and saved', ['order_id' => $order->id, 'file' => $signedFileName]);

            // رفع العقد الموقع على البلوك تشين (IPFS)
            $fullPath = storage_path('app/public/' . $signedFileName);
            $cid = $this->ipfsService->uploadFile($fullPath, basename($signedFileName));
            $blockchainLink = $cid ? ("https://gateway.pinata.cloud/ipfs/" . $cid) : null;

            Log::info('Contract uploaded to IPFS', ['order_id' => $order->id, 'cid' => $cid, 'blockchain_link' => $blockchainLink]);

            // إعادة توليد PDF مع رابط البلوك تشين
            $pdfWithLink = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', [
                'order' => $order,
                'withSignatures' => true,
                'date' => now()->format('Y-m-d'),
                'client' => $order->client,
                'propertyUnit' => $order->propertyUnit,
                'propertyBook' => $order->propertyUnit ? $order->propertyUnit->propertyBook : null,
                'secret_code' => $order->signature_code,
                'client_ip' => $clientIp,
                'blockchain_link' => $blockchainLink,
                'clientInfo' => $clientInfo,
            ]);
            $finalFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '_blockchain.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($finalFileName, $pdfWithLink->output());
            $order->update([
                'contract_file' => $finalFileName,
                'contract_hash' => $cid,
            ]);

            Log::info('Final PDF with blockchain link generated and saved', ['order_id' => $order->id, 'file' => $finalFileName]);

            return [
                'signed_contract_url' => asset('storage/' . $finalFileName),
                'blockchain_link' => $blockchainLink,
            ];
        } catch (\Exception $e) {
            Log::error('Failed to sign contract by client', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
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
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractSigned
            ]);

            // Generate signed PDF with both signatures using the new Blade
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', [
                'order' => $order,
                'withSignatures' => true,
                'date' => now()->format('Y-m-d'),
                'client' => $order->client,
                'propertyUnit' => $order->propertyUnit,
                'propertyBook' => $order->propertyUnit ? $order->propertyUnit->propertyBook : null,
                'secret_code' => $order->signature_code,
                'client_ip' => null,
                'blockchain_link' => null,
            ]);
            $signedFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($signedFileName, $pdf->output());
            $order->update(['contract_file' => $signedFileName]);

            // رفع العقد الموقع على البلوك تشين (IPFS)
            $fullPath = storage_path('app/public/' . $signedFileName);
            $cid = $this->ipfsService->uploadFile($fullPath, basename($signedFileName));
            $blockchainLink = $cid ? ("https://gateway.pinata.cloud/ipfs/" . $cid) : null;

            // إعادة توليد PDF مع رابط البلوك تشين باستخدام البليد الجديد
            $pdfWithLink = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', [
                'order' => $order,
                'withSignatures' => true,
                'date' => now()->format('Y-m-d'),
                'client' => $order->client,
                'propertyUnit' => $order->propertyUnit,
                'propertyBook' => $order->propertyUnit ? $order->propertyUnit->propertyBook : null,
                'secret_code' => $order->signature_code,
                'client_ip' => null,
                'blockchain_link' => $blockchainLink,
            ]);
            $finalFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '_blockchain.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($finalFileName, $pdfWithLink->output());
            $order->update([
                'contract_file' => $finalFileName,
                'contract_hash' => $cid,
            ]);

            \Illuminate\Support\Facades\Log::info('Contract signed by company and uploaded to blockchain', ['order_id' => $order->id, 'cid' => $cid]);
            return [
                'signed_contract_url' => asset('storage/' . $finalFileName),
                'blockchain_link' => $blockchainLink,
            ];
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to sign contract by company', [
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
