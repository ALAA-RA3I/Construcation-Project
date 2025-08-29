<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\PropertyUnitDTO\PropertyUnitDTO;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyUnit\CreatePropertyUnitRequest;
use App\Http\Requests\PropertyUnit\UpdatePropertyUnitRequest;
use App\Http\Resources\PropertyUnitResource;
use Illuminate\Http\Request;

class PropertyUnitController extends Controller
{
    protected $propertyUnitService , $propertyBookService;

    public function __construct(PropertyUnitServiceInterface $propertyUnitService, PropertyBookServiceInterface $propertyBookService)
    {
        $this->propertyUnitService = $propertyUnitService;
        $this->propertyBookService = $propertyBookService;
    }

    public function getPropertyUnitOfBook($bookId)
    {
        $propertyUnits = $this->propertyBookService->getPropertyUnits($bookId);
        return ApiResponse::success(PropertyUnitResource::collection($propertyUnits));
    }

//    public function getAll($bookId)
//    {
//        $propertyUnits = $this->propertyBookService->getAll($bookId);
//        return ApiResponse::success(PropertyUnitResource::collection($propertyUnits));
//    }

    public function show($id)
    {
        $propertyUnit = $this->propertyUnitService->show($id);
        return ApiResponse::success(PropertyUnitResource::make($propertyUnit));
    }

    public function create(CreatePropertyUnitRequest $data)
    {
        $validatedData = PropertyUnitDTO::fromCreateRequest($data->validated());
        $propertyUnit = $this->propertyUnitService->create($validatedData);
        return ApiResponse::success(new PropertyUnitResource($propertyUnit));
    }

    public function update(UpdatePropertyUnitRequest $data, $id)
    {
        $validatedData = PropertyUnitDTO::fromUpdateRequest($data->validated());
        $propertyUnit = $this->propertyUnitService->update($id, $validatedData);
        if (!$propertyUnit)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new PropertyUnitResource($propertyUnit), 'Property Unit updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->propertyUnitService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Property Unit deleted successfully');
    }
}
