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

class ESignatureService implements ESignatureServiceInterface
{
    protected $eSignatureRepo;
    protected $apiClient;
    protected $accessToken;
    protected $accountId;
    protected $propertyUnitOrderRepo;

    public function __construct()
    {
        try {
            $this->apiClient = new ApiClient(new Configuration());
            $this->apiClient->getConfig()->setHost(config('docusign.docusign.baseURI'));

            $privateKeyPath = storage_path('app/' . config('docusign.docusign.privateKeyPath'));
            $privateKey = file_get_contents($privateKeyPath);

            $authBasePath = parse_url(config('docusign.docusign.authBaseURI'), PHP_URL_HOST);
            $this->apiClient->getOAuth()->setOAuthBasePath($authBasePath);

            $scopes = ['signature','impersonation'];

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
        $clinetId = 10;
        $clientEmail = Client::where([
            'id' => $clinetId
        ])->value('email');

        // dd($clientEmail);

        $clientName = Client::where([
            'id' => $clinetId
        ])->value('first_name');

        // dd($clientName);
        $envelopeApi = new EnvelopesApi($this->apiClient);
        $documentPath =  PropertyUnitOrder::where([
            'id' => $unitOrder,
            'client_id' => $clinetId
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
                'status' =>PropertUnitOrderStatusEnum::ContractSigned
            ]);
            

            return [
                'signingUrl' => $view->getUrl(),
                'docusignEnvelope' => $docusignEnvelope,
            ];

        } catch (\Exception $e) {
            throw new \Exception("Failed to create envelope or get signing URL: " . $e->getMessage());
        }
    }

    public function getSignedDocument(string $envelopeId)
    {
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

$filePath = storage_path("app/signed_doc_{$envelopeId}.pdf");

// حفظ الملف
file_put_contents($filePath, $documentContent);
Log::info("Signed document saved at: {$filePath}");

            return $filePath;
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