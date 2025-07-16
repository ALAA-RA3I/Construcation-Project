<?php

namespace App\Http\Resources\Client;

use App\Traits\HasFileHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ClientProjectDetailsResource extends JsonResource
{
    use HasFileHandler ;
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
            'price' => $this->propertyBook->price ?? null,
            'space' => $this->propertyBook->space ?? null,
            'description' => $this->propertyBook->description ?? null,
            'number_of_rooms' => $this->propertyBook->number_of_rooms ?? null,
            'number_of_bathrooms' => $this->propertyBook->number_of_bathrooms ?? null,
            'direction' => $this->propertyBook->direction ?? null,
            'diagram_image' => $this->getAssetFileUrl($this->propertyBook->diagram_image)  ?? null,
            'unit_number' => $this->unit_number ?? null,
            'floor' => $this->floor
        ];
    }
}
