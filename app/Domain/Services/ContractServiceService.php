<?php

namespace App\Domain\Services;

use App\Domain\Services\Contracts\ContractServiceServiceInterface;
use App\Domain\Services\IPFSServiceService;
use App\Models\PropertyBook;
use App\Models\PropertyBookBill;
use App\Models\PropertyUnit;
use App\Models\PropertyUnitOrder;
use App\Models\UserPropertyUnitInstallments;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\Month;
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
            // Metadata للطلب   
            $request = request();
            $clientIp = $request->ip();
            $userAgent = $request->header('User-Agent');
            $browser = $request->header('sec-ch-ua') ?? null;
            $platform = $request->header('sec-ch-ua-platform') ?? null;
            $requestUrl = $request->fullUrl();
            $referer = $request->headers->get('referer');
            $acceptLanguage = $request->header('accept-language');

            // البيانات الأساسية
            $client = $order->client;
            $propertyBook = $order->propertyBook;
            $project = $propertyBook->project ?? null;
            $propertyBookBills = $propertyBook->bills ?? null;

            $property_details = [
                'rooms' => $propertyBook->rooms ?? null,
                'bathrooms' => $propertyBook->bathrooms ?? null,
                'direction' => $propertyBook->direction ?? null,
                'first_payment' => $propertyBook->first_payment ?? null,
                'payment_period' => $propertyBook->payment_period ?? null,
            ];

            $clientSignatureUrl = $order->client_signature_url ?? null;
            $companySignatureUrl = $order->company_signature_url ?? null;

            // تأكد من المسار المحلي لصورة الهوية للـ DomPDF
            $identityLocalPath = null;
            if ($order->identity_file) {
                $identityFullPath = storage_path('app/public/' . $order->identity_file);
                if (file_exists($identityFullPath)) {
                    $identityLocalPath = $identityFullPath;
                }
            }

            // إعداد البيانات للـ Blade
            $viewData = [
                'order' => $order,
                'withSignatures' => $withSignatures,
                'date' => now()->format('Y-m-d'),
                'client' => $client,
                'propertyBook' => $propertyBook,
                'project' => $project,
                'propertyBookBills' => $propertyBookBills,
                'property_details' => $property_details,
                'client_ip' => $clientIp,
                'user_agent' => $userAgent,
                'browser' => $browser,
                'platform' => $platform,
                'request_url' => $requestUrl,
                'referer' => $referer,
                'accept_language' => $acceptLanguage,
                'request_date' => $order->created_at,
                'approval_date' => $order->updated_at,
                'order_payment_amount' => $order->payment_amount ?? null,
                'order_note' => $order->note ?? null,
                'client_signature_url' => $clientSignatureUrl,
                'company_signature_url' => $companySignatureUrl,
                'identity_local_path' => $identityLocalPath, // <-- هنا المسار المحلي
                'project_sales_details' => $project->salesDetails ?? null,
            ];

            // توليد PDF
            $pdf = Pdf::loadView('contracts.pdf', $viewData);
 
            $CompanySignedpdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', $viewData);
            // $signedFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '.pdf';
            // \Illuminate\Support\Facades\Storage::disk('public')->put($signedFileName, $pdf->output());
            // $order->update(['contract_file' => $signedFileName]);


            // اسم ملف العقد
            $contractFileName = 'contracts/contract_' . $order->id . '_' . time() . '.pdf';
            $contractSignedFileName = 'contracts/contract_Company' . $order->id . '_' . time() . '.pdf';

            Storage::disk('public')->put($contractFileName, $pdf->output());
            Storage::disk('public')->put($contractSignedFileName, $CompanySignedpdf->output());

            // تحديث order بمسار العقد
            $order->update([
                'contract_file' => $contractFileName,
                'contract_company_sign'=> $contractSignedFileName
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

            // if (!$this->verifySignatureCode($order, $signatureCode)) {
            //     Log::warning('Invalid signature code', ['order_id' => $order->id]);
            //     throw new \Exception('Invalid signature code');
            // }

            $order->update([
                'client_signed_at' => now(),
                'status' => \App\Domain\Enums\PropertUnitOrderStatusEnum::ContractSigned
            ]);
            ///////////
            $request = request();
            $clientIp = $request->ip();
            $userAgent = $request->header('User-Agent');
            $browser = $request->header('sec-ch-ua') ?? null;
            $platform = $request->header('sec-ch-ua-platform') ?? null;
            $requestUrl = $request->fullUrl();
            $referer = $request->headers->get('referer');
            $acceptLanguage = $request->header('accept-language');

            // البيانات الأساسية
            $client = $order->client;
            $propertyBook = $order->propertyBook;
            $project = $propertyBook->project ?? null;
            $propertyBookBills = $propertyBook->bills ?? null;

            $property_details = [
                'rooms' => $propertyBook->rooms ?? null,
                'bathrooms' => $propertyBook->bathrooms ?? null,
                'direction' => $propertyBook->direction ?? null,
                'first_payment' => $propertyBook->first_payment ?? null,
                'payment_period' => $propertyBook->payment_period ?? null,
            ];

            $clientSignatureUrl = $order->client_signature_url ?? null;
            $companySignatureUrl = $order->company_signature_url ?? null;

            // تأكد من المسار المحلي لصورة الهوية للـ DomPDF
            $identityLocalPath = null;
            if ($order->identity_file) {
                $identityFullPath = storage_path('app/public/' . $order->identity_file);
                if (file_exists($identityFullPath)) {
                    $identityLocalPath = $identityFullPath;
                }
            }
            $order;
            // إعداد البيانات للـ Blade
            $viewData = [
                'order' => $order,
                'withSignatures' => true,
                'date' => now()->format('Y-m-d'),
                'client' => $client,
                'propertyBook' => $propertyBook,
                'project' => $project,
                'propertyBookBills' => $propertyBookBills,
                'property_details' => $property_details,
                'client_ip' => $clientIp,
                'user_agent' => $userAgent,
                'browser' => $browser,
                'platform' => $platform,
                'request_url' => $requestUrl,
                'referer' => $referer,
                'accept_language' => $acceptLanguage,
                'request_date' => $order->created_at,
                'approval_date' => $order->updated_at,
                'order_payment_amount' => $order->payment_amount ?? null,
                'order_note' => $order->note ?? null,
                'client_signature_url' => $clientSignatureUrl,
                'company_signature_url' => $companySignatureUrl,
                'identity_local_path' => $identityLocalPath, // <-- هنا المسار المحلي
                'project_sales_details' => $project->salesDetails ?? null,
            ];




            /////////

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
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', $viewData);
            $signedFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($signedFileName, $pdf->output());
            $order->update(['contract_file' => $signedFileName]);

            Log::info('PDF generated and saved', ['order_id' => $order->id, 'file' => $signedFileName]);

            // رفع العقد الموقع على البلوك تشين (IPFS)
            $fullPath = storage_path('app/public/' . $signedFileName);
            $cid = $this->ipfsService->uploadFile($fullPath, basename($signedFileName));
            $blockchainLink = $cid ? ("https://gateway.pinata.cloud/ipfs/" . $cid) : null;

            Log::info('Contract uploaded to IPFS', ['order_id' => $order->id, 'cid' => $cid, 'blockchain_link' => $blockchainLink]);

            $DATA = [
                'order' => $order,
                'withSignatures' => true,
                'date' => now()->format('Y-m-d'),
                'client' => $client,
                'propertyBook' => $propertyBook,
                'project' => $project,
                'propertyBookBills' => $propertyBookBills,
                'property_details' => $property_details,
                'client_ip' => $clientIp,
                'user_agent' => $userAgent,
                'browser' => $browser,
                'platform' => $platform,
                'request_url' => $requestUrl,
                'referer' => $referer,
                'accept_language' => $acceptLanguage,
                'request_date' => $order->created_at,
                'approval_date' => $order->updated_at,
                'order_payment_amount' => $order->payment_amount ?? null,
                'order_note' => $order->note ?? null,
                'client_signature_url' => $clientSignatureUrl,
                'company_signature_url' => $companySignatureUrl,
                'identity_local_path' => $identityLocalPath, // <-- هنا المسار المحلي
                'project_sales_details' => $project->salesDetails ?? null,

                'blockchain_link' => $blockchainLink,

            ];
            // إعادة توليد PDF مع رابط البلوك تشين
            $pdfWithLink = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', $DATA);
            $finalFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '_blockchain.pdf';
            \Illuminate\Support\Facades\Storage::disk('public')->put($finalFileName, $pdfWithLink->output());
            $order->update([
                'contract_file' => $finalFileName,
                'contract_hash' => $cid,
            ]);
            $propertyUnit = PropertyUnit::create([
                'property_book_id'    => $order->property_book_id,
                'client_id'           => $order->client_id,
                'first_payment_date'  => $order->payment_completed_at,
            ]);

            $propertyBookBills   = PropertyBookBill::where('property_book_id', $order->property_book_id)->get();
            $paymentCompletedAt  = Carbon::parse($order->payment_completed_at);

            $previousDueDate = null;

            foreach ($propertyBookBills as $i => $propertyBookBill) {
                if ($i === 0) {
                    $userInstallment = UserPropertyUnitInstallments::create([
                        'client_id'             => $order->client_id,
                         'property_book_bill_id' => $propertyBookBill->id,
                        'is_paid'               => false,
                        'due_date'              => $paymentCompletedAt->copy()->addMonth(),
                        'property_unit_id' => $propertyUnit->id

                    ]);
                    $previousDueDate = Carbon::parse($userInstallment->due_date);
                } else {

                    $userInstallment = UserPropertyUnitInstallments::where('property_unit_id', $propertyUnit->id)->orderBy('due_date', 'desc')
                        ->first();
                    $previousDueDate = Carbon::parse($userInstallment->due_date);

                    $nextDueDate = $previousDueDate->copy()->addMonth();

                    $userInstallment = UserPropertyUnitInstallments::create([
                        'client_id'             => $order->client_id,
                         'property_book_bill_id' => $propertyBookBill->id,
                        'is_paid'               => false,
                        'due_date'              => $nextDueDate,
                        'property_unit_id' => $propertyUnit->id
                    ]);

                    $previousDueDate = $nextDueDate;
                }
            }

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
