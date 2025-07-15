<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyUnitOrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'property_unit_id' => $this->property_unit_id,
            'client' => new ClientResource($this->whenLoaded('client')),
            'identity_file' => $this->identity_file ? asset('storage/' . $this->identity_file) : null,
            'clearance_certificate' => $this->clearance_certificate ? asset('storage/' . $this->clearance_certificate) : null,
            'status' => $this->status,
            'note' => $this->note,
            'property_unit' => new PropertyUnitResource($this->whenLoaded('propertyUnit')),

            // حقول العقد
            'contract_file' => $this->contract_file ? asset('storage/' . $this->contract_file) : null,
            'contract_hash' => $this->contract_hash,
            'contract_sent_at' => $this->contract_sent_at,

            // حقول التوقيع
            'signature_code_sent_at' => $this->signature_code_sent_at,
            'client_signed_at' => $this->client_signed_at,
            'company_signed_at' => $this->company_signed_at,

            // حقول الدفع
            'payment_intent_id' => $this->payment_intent_id,
            'payment_amount' => $this->payment_amount,
            'payment_completed_at' => $this->payment_completed_at,

            // حقول إضافية
            'activation_token_sent_at' => $this->activation_token_sent_at,
            'account_activated_at' => $this->account_activated_at,

            // حقول محسوبة
            'is_client_signed' => $this->isClientSigned(),
            'is_company_signed' => $this->isCompanySigned(),
            'is_payment_completed' => $this->isPaymentCompleted(),
            'contract_file_url' => $this->contract_file_url,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
