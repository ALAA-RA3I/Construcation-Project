<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultingEngineerResource extends JsonResource
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
            'user_id' => $this->user_id,
            'consulting_company_id' => $this->consulting_company_id,
            'engineer_specialization_id' => $this->engineer_specialization_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'specialization' => new EngineerSpecializationResource($this->whenLoaded('specialization')),
//            'consulting_company' => new EngineerSpecializationResource($this->whenLoaded('consultingCompany')),

        ];    }
}
