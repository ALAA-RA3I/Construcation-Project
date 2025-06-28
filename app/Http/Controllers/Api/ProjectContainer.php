<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectContainerDTO\ProjectContainerDTO;
use App\Application\DTO\ProjectContainerDTO\ItemIfExistDTO;
use App\Domain\Services\Contracts\ProjectContainerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectContainer\CreateContainerRequset;
use App\Http\Requests\ProjectContainer\CreateItemsIfNotFoundRequset;
use App\Http\Resources\ProjectContainer\ProjectContainerResource;
use Illuminate\Http\Request;

class ProjectContainer extends Controller
{
    protected $projectContainerService;

    public function __construct(ProjectContainerServiceInterface $projectContainerService)
    {
        $this->projectContainerService = $projectContainerService;
    }

    public function createIfNotExisit(CreateItemsIfNotFoundRequset $requset,$id) {
        $data = ProjectContainerDTO::fromCreateRequest($requset->validated(),$id);
        $dataValidated = $this->projectContainerService->createIfNotExisit($data,$id);
        $dataValidated->load(['project', 'items']);
        return ApiResponse::success(new ProjectContainerResource($dataValidated));
    }

    public function createIfExisit(CreateContainerRequset $requset,$projectID,$itemId) {
        $data = ItemIfExistDTO::fromCreateRequest($requset->validated(),$projectID,$itemId);
        $dataValidated = $this->projectContainerService->createIfExisit($data,$projectID,$itemId);
        $dataValidated->load(['project', 'items']);
        return ApiResponse::success(new ProjectContainerResource($dataValidated));
    }

    public function getAll($id) {
        $data = $this->projectContainerService->getAll($id);
        $data->load(['items']);
        return ApiResponse::success(ProjectContainerResource::collection($data));
    }

    public function show($id) {
        $data = $this->projectContainerService->show($id);
        $data->load(['items']);
        return ApiResponse::success(ProjectContainerResource::make($data));
    }

    public function delete($id) {
        $data = $this->projectContainerService->delete($id);
        if(!$data) {
            return ApiResponse::error('Something went wrong');
        }return ApiResponse::success('','Deleted successfully',200);
    }
}
