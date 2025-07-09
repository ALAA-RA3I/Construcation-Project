<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectBillsResource extends JsonResource
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
            'description' => $this->description,
            'date_of_payment' => $this->date_of_payment,
            'project_id' => $this->project_id,
            'total_cost' => $this->total_cost,
            'details' => ProjectBillDetailsResource::collection($this->whenLoaded('billsDetails'))
        ];
    }
}
