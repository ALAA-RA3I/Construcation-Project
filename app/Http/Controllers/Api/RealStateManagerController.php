<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\RealStateDTO\RealStateManagerDTO;
use App\Domain\Services\Contracts\RealStateManagerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealStateManager\CreateRealStateManagerRequest;
use App\Http\Requests\RealStateManager\UpdateRealStateManagerRequest;
use App\Http\Resources\RealStateManagerResource;
use Illuminate\Http\Request;

class RealStateManagerController extends Controller
{
    protected $realStateManagerService;

    public function __construct(RealStateManagerServiceInterface $realStateManagerService)
    {   
        $this->realStateManagerService = $realStateManagerService;
    }

    public function index() {
        $realStateManagers = $this->realStateManagerService->paginate();
        return ApiResponse::success(RealStateManagerResource::collection($realStateManagers));
    }

    public function getAll() {
        $realStateManagers = $this->realStateManagerService->getAll();
        return ApiResponse::success(RealStateManagerResource::collection($realStateManagers));
    }

    public function show($id) {
        $realStateManager = $this->realStateManagerService->show($id);
        return ApiResponse::success(RealStateManagerResource::make($realStateManager));
    }

    public function create(CreateRealStateManagerRequest $data) {
        $validatedData = RealStateManagerDTO::fromCreateRequest($data->validated());
        $realStateManager = $this->realStateManagerService->create($validatedData);
        return ApiResponse::success(new RealStateManagerResource($realStateManager));
    }

    public function update(UpdateRealStateManagerRequest $data , $id) {
        $validatedData = RealStateManagerDTO::fromUpdateRequest($data->validated());
        $realStateManager = $this->realStateManagerService->update($id,$validatedData);
        if (!$realStateManager) 
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(null,'Information updated successfully');
    }

    public function delete($id) {
        $deleted = $this->realStateManagerService->delete($id);

        if(!$deleted)
            return ApiResponse::error('deleted falied successfully :)', 400);
        return ApiResponse::success(null ,'Manager deleted successfully');
    }

}
