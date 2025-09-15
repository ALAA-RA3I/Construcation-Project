<?php

namespace App\Http\Resources;

use App\Traits\HasFileHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectFileResource extends JsonResource
{
    use HasFileHandler;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file_path' => $this->getStorageFileUrl($this->file_path),
            'description' => $this->description,
            'project_id' => 1,
            'project_participant_id' => 1,
        ];
    }
}
