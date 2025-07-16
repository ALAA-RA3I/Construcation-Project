<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientProjectNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $project = $this->project;
        $salesDetails = optional($project)->salesDetails;

        return [
            'id' => $this->id,
            'description' => $this->description,
            'file_url' => asset('storage/' . $this->path_file),
            'created_at' => $this->created_at?->toDateTimeString(),
            'main_title' => $salesDetails->main_title ?? null,
        ];
    }
}
