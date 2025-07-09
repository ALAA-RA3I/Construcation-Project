<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectContainerDTO\ProjectContainerDTO;
use App\Application\DTO\ProjectContainerDTO\ItemIfExistDTO;
use App\Domain\Services\Contracts\ProjectContainerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectContainer\AddItemsToWarehouseRequest;
use App\Http\Requests\ProjectContainer\CreateContainerRequset;
use App\Http\Requests\ProjectContainer\CreateItemsIfNotFoundRequset;
use App\Http\Requests\ProjectContainer\UpdateItemContainerRequest;
use App\Http\Resources\ProjectContainer\ProjectContainerReportsResource;
use App\Http\Resources\ProjectContainer\ProjectContainerResource;
use App\Http\Resources\ProjectContainer\ProjectWareHouseResource;
use Illuminate\Http\Request;

class ProjectContainerController extends Controller
{
    protected $projectContainerService;

    public function __construct(ProjectContainerServiceInterface $projectContainerService)
    {
        $this->projectContainerService = $projectContainerService;
    }

    public function createIfNotExisit(CreateItemsIfNotFoundRequset $request,$id) {
        $data = ProjectContainerDTO::fromCreateRequest($request->validated(),$id);
        $dataValidated = $this->projectContainerService->createIfNotExisit($data,$id);
        $dataValidated->load(['project', 'items']);
        return ApiResponse::success(new ProjectContainerResource($dataValidated));
    }

    public function createIfExisit(CreateContainerRequset $request,$id) {
        $data = ItemIfExistDTO::fromCreateRequest($request->validated(),$id);
        $dataValidated = $this->projectContainerService->createIfExisit($data,$id);
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
    public function getProjectContainerAsReports($id)
    {
        $data = $this->projectContainerService->getProjectContainerReports($id);
        return ApiResponse::success(ProjectContainerReportsResource::collection($data));
    }
    public function getProjectWareHouseContent($id)
    {
        $data = $this->projectContainerService->getProjectWareHouse($id);
        return ApiResponse::success(ProjectWareHouseResource::collection($data));
    }
    public function addItemsToWarehouse($projectId, AddItemsToWarehouseRequest $request)
    {
        $this->projectContainerService->addItemsToWarehouse($projectId, $request->validated());
        return ApiResponse::success(null, 'Items added successfully');
    }
}
