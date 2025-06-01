<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ItemDTO\ItemDTO;
use App\Domain\Services\Contracts\ItemServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemServiceInterface $itemService)
    {   
        $this->itemService = $itemService;
    }

    public function index() {
        $items = $this->itemService->paginate();
        return ApiResponse::success(ItemResource::collection($items));
    }

    public function getAll() {
        $items = $this->itemService->getAll();
        return ApiResponse::success(ItemResource::collection($items));
    }

    public function create(CreateItemRequest $request) {
        $validatedData = ItemDTO::fromCreateRequest($request->validated());
        $item = $this->itemService->create($validatedData);
        return ApiResponse::success(new ItemResource($item), 'Item created successfully');
    }

    public function show($id) {
        $item = $this->itemService->show($id);
        if (!$item) 
            return ApiResponse::error('Item not found', 404);
        return ApiResponse::success(new ItemResource($item));
    }

    public function update(UpdateItemRequest $request, $id) {
        $validatedData = ItemDTO::fromUpdateRequest($request->validated());
        $item = $this->itemService->update($id, $validatedData);
        if (!$item) 
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ItemResource($item), 'Item updated successfully');
    }

    public function delete($id) {
        $deleted = $this->itemService->delete($id);

        if(!$deleted)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(null, 'Item deleted successfully');
    }
}