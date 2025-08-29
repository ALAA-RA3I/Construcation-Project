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

    public function testDocuSign($orderId)
    {
         $response  = $this->eSignDoc->signContractByClient($orderId);

        return redirect()->away($response['signingUrl']);
    }

    public function downloadSignedDoc(int $unitOrder,Request $request)
    {
        try {
            // We use the ID from the database to find the document
            $docuSignEnvelope = PropertyUnitOrder::findOrFail($unitOrder);
            $envelopeId = $docuSignEnvelope->contract_signed_id;
            // dd($envelopeId);

            $signedDocPath = $this->eSignDoc->getSignedDocument($request,$envelopeId,$unitOrder);
            return response()->download($signedDocPath);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
