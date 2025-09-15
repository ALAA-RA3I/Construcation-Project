<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\PropertyUnitOrderDTO\PropertyUnitOrderDTO;
use App\Domain\Services\Contracts\PropertyUnitOrderServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyUnitOrder\CreatePropertyUnitOrderRequest;
use App\Http\Requests\PropertyUnitOrder\UpdatePropertyUnitOrderRequest;
use App\Http\Resources\PropertyUnitOrderResource;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PropertyUnitOrderController extends Controller
{
    protected $propertyUnitOrderService;

    public function __construct(PropertyUnitOrderServiceInterface $propertyUnitOrderService)
    {
        $this->propertyUnitOrderService = $propertyUnitOrderService;
    }

    public function index()
    {
        $orders = $this->propertyUnitOrderService->paginate();
        return ApiResponse::success(PropertyUnitOrderResource::collection($orders));
    }

    public function getAll()
    {
        $orders = $this->propertyUnitOrderService->getAll();
        return ApiResponse::success(PropertyUnitOrderResource::collection($orders));
    }

    public function show($id)
    {
        $order = $this->propertyUnitOrderService->show($id);
        return ApiResponse::success(PropertyUnitOrderResource::make($order));
    }

    public function create(CreatePropertyUnitOrderRequest $data)
    {
          $validatedData = PropertyUnitOrderDTO::fromCreateRequest($data->validated());
        $order = $this->propertyUnitOrderService->create($validatedData);
        return ApiResponse::success(new PropertyUnitOrderResource($order));
    }

    public function update(UpdatePropertyUnitOrderRequest $data, $id)
    {
        $validatedData = PropertyUnitOrderDTO::fromUpdateRequest($data->validated());
        $order = $this->propertyUnitOrderService->update($id, $validatedData);
        if (!$order)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new PropertyUnitOrderResource($order), 'Property Unit Order updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->propertyUnitOrderService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Property Unit Order deleted successfully');
    }
}
