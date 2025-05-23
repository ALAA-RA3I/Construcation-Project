<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultingCompanyResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'focal_point_first_name' => $this->focal_point_first_name,
            'focal_point_last_name' => $this->focal_point_last_name,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'land_line' => $this->land_line,
            'license_number' => $this->license_number,
        ];
    }
}
