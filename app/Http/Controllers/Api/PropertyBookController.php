<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\PropertyBookDTO\PropertyBookDTO;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyBook\CreatePropertyBookRequest;
use App\Http\Requests\PropertyBook\UpdatePropertyBookRequest;
use App\Http\Resources\PropertyBookResource;
use Illuminate\Http\Request;

class PropertyBookController extends Controller
{
    protected $propertyBookService;

    public function __construct(PropertyBookServiceInterface $propertyBookService)
    {
        $this->propertyBookService = $propertyBookService;
    }

    public function index()
    {
        $propertyBooks = $this->propertyBookService->paginate();
        return ApiResponse::success(PropertyBookResource::collection($propertyBooks));
    }

    public function getAll()
    {
        $propertyBooks = $this->propertyBookService->getAll();
        return ApiResponse::success(PropertyBookResource::collection($propertyBooks));
    }

    public function show($id)
    {
        $propertyBook = $this->propertyBookService->show($id);
        return ApiResponse::success(PropertyBookResource::make($propertyBook));
    }

    public function create(CreatePropertyBookRequest $data)
    {
        $validatedData = PropertyBookDTO::fromCreateRequest($data->validated());
        $propertyBook = $this->propertyBookService->create($validatedData);
        return ApiResponse::success(new PropertyBookResource($propertyBook));
    }

    public function update(UpdatePropertyBookRequest $data, $id)
    {
         $validatedData = PropertyBookDTO::fromUpdateRequest($data->validated());
        $propertyBook = $this->propertyBookService->update($id, $validatedData);
        if (!$propertyBook)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new PropertyBookResource($propertyBook), 'Property Book updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->propertyBookService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Property Book deleted successfully');
    }
}
