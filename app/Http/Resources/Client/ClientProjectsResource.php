<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientProjectsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $project = optional($this->propertyBook)->project;
        $salesDetails = optional($project)->salesDetails;

        return [
            'id' => $this->id,
            'main_title' => $salesDetails->main_title ?? null,
            'marketing_description' => $salesDetails->marketing_description ?? null,
            'address' => $salesDetails->address ?? null,
            'expected_date_of_completed' => $project->expected_date_of_completed ?? null,
            'progress_percentage' => $project->progress_percentage ?? 0,
        ];
    }
}
