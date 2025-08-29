<?php

namespace App\Domain\Services;

use App\Models\Enveloped;
use DocuSign\eSign\Configuration;
use DocuSign\eSign\Client\ApiClient;
use DocuSign\eSign\Api\EnvelopesApi;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\Signer;
use DocuSign\eSign\Model\SignHere;
use DocuSign\eSign\Model\Tabs;
use DocuSign\eSign\Model\RecipientViewRequest;
use Illuminate\Support\Facades\Log;
use App\Domain\Services\Contracts\ESignatureServiceInterface;
use App\Models\Client;
use App\Models\PropertyUnitOrder;
use App\Domain\Enums\PropertUnitOrderStatusEnum;

use App\Domain\Services\Contracts\ContractServiceServiceInterface;
use App\Models\PropertyBook;
use App\Models\PropertyBookBill;
use App\Models\PropertyUnit;
use App\Models\UserPropertyUnitInstallments;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ESignatureService implements ESignatureServiceInterface
{
    protected $eSignatureRepo;
    protected $apiClient;
    protected $accessToken;
    protected $accountId;
    protected $propertyUnitOrderRepo;
    protected $ipfsService;

    public function __construct(IPFSServiceService $ipfsService = null)
    {
        $this->ipfsService = $ipfsService ?? app(IPFSServiceService::class);

        try {
            $this->apiClient = new ApiClient(new Configuration());
            $this->apiClient->getConfig()->setHost(config('docusign.docusign.baseURI'));

            $privateKeyPath = storage_path('app/' . config('docusign.docusign.privateKeyPath'));
            $privateKey = file_get_contents($privateKeyPath);

            $authBasePath = parse_url(config('docusign.docusign.authBaseURI'), PHP_URL_HOST);
            $this->apiClient->getOAuth()->setOAuthBasePath($authBasePath);

            $scopes = ['signature', 'impersonation'];

            $response = $this->apiClient->requestJWTUserToken(
                config('docusign.docusign.integrationKey'),
                config('docusign.docusign.userId'),
                $privateKey,
                $scopes,
                3600
            );

            $this->accessToken = $response[0]['access_token'];
            $userInfo = $this->apiClient->getUserInfo($this->accessToken)[0];
            $accounts = $userInfo->getAccounts();

            if (!empty($accounts)) {
                $this->accountId = $accounts[0]->getAccountId();
            } else {
                throw new \Exception("No accounts found for this user.");
            }
        } catch (\Exception $e) {
            throw new \Exception("Failed to authenticate with DocuSign: " . $e->getMessage());
        }
    }

    public function signContractByClient($unitOrder)
    {
        // $clinetId = 11;
        // $unitOrder=22;
        $order = PropertyUnitOrder::find($unitOrder);
        $clientEmail = Client::where([
            'id' => $order->client_id
        ])->value('email');

        // dd($clientEmail);

        $clientName = Client::where([
            'id' => $order->client_id
        ])->value('first_name');

        // dd($clientName);
        $envelopeApi = new EnvelopesApi($this->apiClient);
        $documentPath =  PropertyUnitOrder::where([
            'id' => $unitOrder,
            'client_id' => $order->client_id
        ])->value('contract_file');

        // dd($documentPath);
        $fullDocumentPath = storage_path('app/public/' . $documentPath);
        try {
            $documentContent = base64_encode(file_get_contents($fullDocumentPath));

            $document = new Document([
                'document_base64' => $documentContent,
                'name' => 'Contract Document',
                'file_extension' => 'pdf',
                'document_id' => '1'
            ]);

            $signHere = new SignHere([
                'anchor_string' => 'Client Signature',
                'anchor_y_offset' => "80",                  // إزاحة عمودية: قيمة موجبة لتحريك التوقيع للأسفل
                'anchor_x_offset' => "30",                   // إزاحة أفقية: صفر أو قيمة صغيرة لضبط الموضع الأفقي
                'anchor_ignore_if_not_found' => "false",    // مهم جداً لضمان العثور على الكلمة
                'document_id' => "1",
                'page_number' => "4"
            ]);

            $tabs = new Tabs([
                'sign_here_tabs' => [$signHere]
            ]);

            $signer = new Signer([
                'email' => $clientEmail,
                'name' => $clientName,
                'recipient_id' => '1',
                'routing_order' => '1',
                'client_user_id' => '12345'
            ]);
            $signer->setTabs($tabs);

            $envelopeDefinition = new EnvelopeDefinition([
                'email_subject' => "Contract for selling a book",
                'documents' => [$document],
                'recipients' => ['signers' => [$signer]],
                'status' => "sent"
            ]);

            $envelopeSummary = $envelopeApi->createEnvelope($this->accountId, $envelopeDefinition);

            $envelopeId = $envelopeSummary->getEnvelopeId();

            $recipientViewRequest = new RecipientViewRequest([
                'authentication_method' => 'none',
                'client_user_id' => '12345',
                'recipient_id' => '1',
                'return_url' => route('myOrders'),
                'user_name' => $clientName,
                'email' => $clientEmail
            ]);

            $view = $envelopeApi->createRecipientView($this->accountId, $envelopeId, $recipientViewRequest);

            $docusignEnvelope = PropertyUnitOrder::where('id', $unitOrder)
                ->update([
                    'contract_signed_id' => $envelopeId,
                    'status' => PropertUnitOrderStatusEnum::ContractSigned
                ]);

            Log::info($view->getUrl());

            return [
                'signingUrl' => $view->getUrl(),
                'docusignEnvelope' => $docusignEnvelope,
            ];
        } catch (\Exception $e) {
            throw new \Exception("Failed to create envelope or get signing URL: " . $e->getMessage());
        }
    }

    public function getSignedDocument(Request $request, string $envelopeId, $order)
    {
        $order = PropertyUnitOrder::findOrFail($order);
        $envelopeApi = new EnvelopesApi($this->apiClient);

        try {
            // Get envelope status
            $envelope = $envelopeApi->getEnvelope($this->accountId, $envelopeId);
            $status = $envelope->getStatus();
            Log::info("DocuSign Envelope Status => {$status}");

            if ($status !== 'completed') {
                Log::critical("Envelope is not completed yet. Current status: $status");
            }

            // Get documents list
            $docsList = $envelopeApi->listDocuments($this->accountId, $envelopeId);
            $envelopeDocs = $docsList->getEnvelopeDocuments();

            if (empty($envelopeDocs)) {
                throw new \Exception("No documents found for envelope {$envelopeId}");
            }

            // Use the combined document ID, which is always available after completion
            $documentId = 'combined';
            Log::info("Fetching combined document for envelope {$envelopeId}");

            // Fetch the document content
            $response = $envelopeApi->getDocument($this->accountId, $documentId, $envelopeId);

            $documentContent = '';
            if ($response instanceof \SplFileObject) {
                // اقرأ الملف بالكامل كسلسلة بايتات
                $response->rewind();
                while (!$response->eof()) {
                    $documentContent .= $response->fread(8192); // اقرأ chunk-by-chunk
                }
            } else {
                $documentContent = (string) $response;
            }

            if (empty($documentContent)) {
                throw new \Exception("Failed to retrieve document content. Response was empty.");
            }

            // $filePath = storage_path("app/signed_doc_{$envelopeId}.pdf");
            // اسم الملف النسبي
            $signedFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '_blockchain.pdf';

            // المسار الكامل
            $fullPath = storage_path('app/public/' . $signedFileName);

            // تأكد من وجود مجلد contracts
            if (!file_exists(dirname($fullPath))) {
                mkdir(dirname($fullPath), 0777, true);
            }

            // حفظ الملف في storage
            file_put_contents($fullPath, $documentContent);

            Log::info("Signed document saved at: {$fullPath}");

            // تحديث order بالمسار النسبي فقط
            $order->update([
                'contract_file' => $signedFileName,
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

            // // توليد PDF أولي بدون رابط بلوك تشين
            // $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', $viewData);
            // $signedFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '.pdf';
            // \Illuminate\Support\Facades\Storage::disk('public')->put($signedFileName, $pdf->output());
            // $order->update(['contract_file' => $signedFileName]);

            Log::info('PDF generated and saved', ['order_id' => $order->id, 'file' => $signedFileName]);

            // رفع العقد الموقع على البلوك تشين (IPFS)
            $fullPath = storage_path('app/public/' . $signedFileName);
            $cid = $this->ipfsService->uploadFile($fullPath, basename($signedFileName));
            $blockchainLink = $cid ? ("https://gateway.pinata.cloud/ipfs/" . $cid) : null;

            Log::info('Contract uploaded to IPFS', ['order_id' => $order->id, 'cid' => $cid, 'blockchain_link' => $blockchainLink]);

            // $DATA = [
            //     'order' => $order,
            //     'withSignatures' => true,
            //     'date' => now()->format('Y-m-d'),
            //     'client' => $client,
            //     'propertyBook' => $propertyBook,
            //     'project' => $project,
            //     'propertyBookBills' => $propertyBookBills,
            //     'property_details' => $property_details,
            //     'client_ip' => $clientIp,
            //     'user_agent' => $userAgent,
            //     'browser' => $browser,
            //     'platform' => $platform,
            //     'request_url' => $requestUrl,
            //     'referer' => $referer,
            //     'accept_language' => $acceptLanguage,
            //     'request_date' => $order->created_at,
            //     'approval_date' => $order->updated_at,
            //     'order_payment_amount' => $order->payment_amount ?? null,
            //     'order_note' => $order->note ?? null,
            //     'client_signature_url' => $clientSignatureUrl,
            //     'company_signature_url' => $companySignatureUrl,
            //     'identity_local_path' => $identityLocalPath, // <-- هنا المسار المحلي
            //     'project_sales_details' => $project->salesDetails ?? null,

            //     'blockchain_link' => $blockchainLink,

            // ];
            // // إعادة توليد PDF مع رابط البلوك تشين
            // $pdfWithLink = \Barryvdh\DomPDF\Facade\Pdf::loadView('contracts.signed_contract', $DATA);
            // $finalFileName = 'contracts/signed_contract_' . $order->id . '_' . time() . '_blockchain.pdf';
            // \Illuminate\Support\Facades\Storage::disk('public')->put($finalFileName, $pdfWithLink->output());
            $order->update([
                'contract_file' => $signedFileName,
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

            Log::info('Final PDF with blockchain link generated and saved', ['order_id' => $order->id, 'file' => $signedFileName]);

            // return [
            //     'signed_contract_url' => asset('storage/' . $signedFileName),
            //     'blockchain_link' => $blockchainLink,
            // ];
            return $signedFileName;
        } catch (\Exception $e) {
            Log::critical("Failed to get signed document: " . $e->getMessage());
            throw $e;
        }
    }

    // public function getAll()
    // {
    //     return $this->eSignatureRepo->all();
    // }

    // public function paginate()
    // {
    //     return $this->eSignatureRepo->paginate();
    // }

    // public function create(array $data)
    // {
    //     return $this->eSignatureRepo->create($data);
    // }

    // public function show($id)
    // {
    //     return $this->eSignatureRepo->find($id);
    // }

    // public function update($id, array $data)
    // {
    //     return $this->eSignatureRepo->update($data, $id);
    // }

    // public function delete($id)
    // {
    //     return $this->eSignatureRepo->delete($id);
    // }
}
