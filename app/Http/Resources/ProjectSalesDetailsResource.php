<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectSalesDetailsResource extends JsonResource
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
            'project_id' => $this->project_id,
            'main_title' => $this->main_title,
            'marketing_description' => $this->marketing_description,
            'location_link' => $this->location_link,
            'address' => $this->address,
            'video_url' => $this->video_url ? asset('storage/' . $this->video_url) : null,
            'main_image' => $this->main_image ? asset('storage/' . $this->main_image) : null,
            'diagram_image' => $this->diagram_image ? asset('storage/' . $this->diagram_image) : null,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
