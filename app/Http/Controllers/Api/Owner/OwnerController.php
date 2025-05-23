<?php

namespace App\Http\Controllers\Api\Owner;

use App\Application\DTO\Owner\OwnerDTO;
use App\Domain\Services\Contracts\Owner\OwnerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Engineer\CreateEngineerRequest;
use App\Http\Requests\Owner\CreateOwnerRequest;
use App\Http\Requests\Owner\UpdateOwnerRequest;
use App\Http\Resources\OwnerResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    private  $ownerService;

    public function __construct(OwnerServiceInterface $service)
    {
        $this->ownerService = $service;
    }
    public function index()
    {
        $owners = $this->ownerService->paginate();
        return ApiResponse::success(OwnerResource::collection($owners));
    }
    public function getAll(Request $request)
    {
        $owners = $this->ownerService->getAll();
        return ApiResponse::success(ownerResource::collection($owners));
    }
    public function create(CreateOwnerRequest $request)
    {
        $data = OwnerDTO::fromCreateRequest($request->validated());
        $owner = $this->ownerService->create($data);
        return ApiResponse::success(new UserResource($owner), 'owner created successfully', 201);
    }
    public function show($id)
    {
        $owner = $this->ownerService->show($id);
        return ApiResponse::success(new OwnerResource($owner));
    }
    public function update(UpdateOwnerRequest $request, $id)
    {
         $data = OwnerDTO::fromUpdateRequest($request->validated());
        $updated = $this->ownerService->update($id, $data);

        if (!$updated) {
            return ApiResponse::error('owner not updated', 404);
        }
        return ApiResponse::success(null, 'owner updated successfully');
    }
    public function delete($id)
    {
        $deleted = $this->ownerService->delete($id);

        if (!$deleted) {
            return ApiResponse::error('owner not deleted', 404);
        }

        return ApiResponse::success(null, 'owner deleted successfully');
    }
}
