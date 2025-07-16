<?php

namespace App\Http\Controllers\Clients;

use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ClientProjectDetailsResource;
use App\Http\Resources\Client\ClientProjectNewsResource;
use App\Http\Resources\Client\ClientProjectsResource;

class ClientProjectsController extends Controller
{
    private $propertyUnitService ;
    public function __construct( PropertyUnitServiceInterface $propertyUnitService) {
        $this->propertyUnitService = $propertyUnitService ;
    }

    public function getProjects()
    {
        $clientId = auth()->id();
        $projects = $this->propertyUnitService->getProjectsOfClient($clientId);
        return ApiResponse::success(ClientProjectsResource::collection($projects),'Client Projects Return Successfully');
    }
    public function getProjectDetails($propertyUnitId)
    {
        $project = $this->propertyUnitService->getProjectDetailsByPropertyUnit($propertyUnitId);

        if (!$project) {
            return ApiResponse::error('Project not found', 404);
        }

        return ApiResponse::success(new ClientProjectDetailsResource($project), 'Client Project Details Returned Successfully');
    }
    public function getClientProjectsNews()
    {
        $clientId = auth()->id();
        $news = $this->propertyUnitService->getClientProjectNews($clientId);

        if ($news->isEmpty()) {
            return ApiResponse::success([], 'No project news found for this client.');
        }
        return ApiResponse::success(ClientProjectNewsResource::collection($news), 'Client Project News Retrieved Successfully');
    }
}
