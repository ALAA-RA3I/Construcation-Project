<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BillsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'due_date' => $this->due_date,
            'is_paid' => $this->is_paid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'property_unit_id' => new PropertyUnitsResources($this->whenLoaded('propertyUnit')),
            'property_book_bill_id' => new PropertyBookBillsResources($this->whenLoaded('propertyBookBill'))
        ];
    }
}
