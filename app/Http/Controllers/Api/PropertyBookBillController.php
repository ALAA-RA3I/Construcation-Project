<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\PropertyBookBillDTO\PropertyBookBillDTO;
use App\Domain\Services\Contracts\PropertyBookBillServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyBookBill\CreatePropertyBookBillRequest;
use App\Http\Requests\PropertyBookBill\UpdatePropertyBookBillRequest;
use App\Http\Resources\PropertyBookBillResource;
use Illuminate\Http\Request;

class PropertyBookBillController extends Controller
{
    protected $propertyBookBillService;

    public function __construct(PropertyBookBillServiceInterface $propertyBookBillService)
    {
        $this->propertyBookBillService = $propertyBookBillService;
    }

    public function index($propertyBookId)
    {
        $propertyBookBills = $this->propertyBookBillService->paginate($propertyBookId);
        return ApiResponse::success(PropertyBookBillResource::collection($propertyBookBills));
    }

    public function getAll($propertyBookId)
    {
        $propertyBookBills = $this->propertyBookBillService->getAll($propertyBookId);
        return ApiResponse::success(PropertyBookBillResource::collection($propertyBookBills));
    }

    public function show($id)
    {
        $propertyBookBill = $this->propertyBookBillService->show($id);
        return ApiResponse::success(PropertyBookBillResource::make($propertyBookBill));
    }

    public function create(CreatePropertyBookBillRequest $data)
    {
        $validatedData = PropertyBookBillDTO::fromCreateRequest($data->validated());
        $propertyBookBill = $this->propertyBookBillService->create($validatedData);
        return ApiResponse::success(new PropertyBookBillResource($propertyBookBill));
    }

    public function update(UpdatePropertyBookBillRequest $data, $id)
    {
        $validatedData = PropertyBookBillDTO::fromUpdateRequest($data->validated());
        $propertyBookBill = $this->propertyBookBillService->update($id, $validatedData);
        if (!$propertyBookBill)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new PropertyBookBillResource($propertyBookBill), 'Property Book Bill updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->propertyBookBillService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Property Book Bill deleted successfully');
    }
}
