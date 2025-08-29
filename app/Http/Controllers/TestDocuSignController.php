<?php

namespace App\Http\Controllers;

use App\Domain\Services\ESignatureService;
use App\Models\PropertyUnitOrder;
use Illuminate\Http\Request;

class TestDocuSignController extends Controller
{
    protected $eSignDoc;

    public function __construct(ESignatureService $eSignDoc)
    {
        $this->eSignDoc = $eSignDoc;
    }

    public function testDocuSign()
    {
        $unitOrderId = 20; // أو أي رقم تعريف (ID) آخر لطلب الوحدة لديك
    $result = $this->eSignDoc->signContractByClient($unitOrderId);

    return response()->json($result);  
    }

    public function downloadSignedDoc(int $unitOrder)
    {
        try {
            // We use the ID from the database to find the document
            $docuSignEnvelope = PropertyUnitOrder::findOrFail($unitOrder);
            $envelopeId = $docuSignEnvelope->contract_signed_id;
            // dd($envelopeId);

            $signedDocPath = $this->eSignDoc->getSignedDocument($envelopeId);
            return response()->download($signedDocPath);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
