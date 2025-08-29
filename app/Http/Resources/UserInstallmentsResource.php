<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserInstallmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'due_date'    => $this->due_date,
            'is_paid'     => (bool) $this->is_paid,
            'amount' => $this->propertyBookBill->amount,
            'description' => $this->propertyBookBill->description
        ];
    }
}
