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
            'priority_number' => $this->priority_number,
            'property_book_id' => $this->property_book_id,
            'book' => new PropertyBookBillResource($this->whenLoaded('propertyBook')),
            'client_id' => $this->client_id,
            'client' => new ClientResource($this->whenLoaded('client')),
            'identity_file' => $this->identity_file ? asset('storage/' . $this->identity_file) : null,
            'status' => $this->status,
            'note' => $this->note,

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
            'is_client_signed' => $this->resource instanceof \App\Models\PropertyUnitOrder ? $this->resource->isClientSigned() : null,
            'is_company_signed' => $this->resource instanceof \App\Models\PropertyUnitOrder ? $this->resource->isCompanySigned() : null,
            'is_payment_completed' => $this->resource instanceof \App\Models\PropertyUnitOrder ? $this->resource->isPaymentCompleted() : null,
            'contract_file_url' => $this->contract_file_url,

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
