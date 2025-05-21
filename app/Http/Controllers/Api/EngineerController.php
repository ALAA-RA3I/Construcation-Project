<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\Engineer\EngineerDTO;
use App\Domain\Services\Contracts\EngineerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Engineer\CreateEngineerRequest;
use App\Http\Requests\Engineer\UpdateEngineerRequest;
use App\Http\Resources\EngineerResource;
use Illuminate\Http\Request;

class EngineerController extends Controller
{
    private  $engineerService ;

    public function __construct(EngineerServiceInterface $service)
    {
        $this->engineerService = $service;
    }
    public function index()
    {
//        $data =  getRequestFilters($request);
//        $engineers = $this->engineerService->paginate($data['filters'], $data['search'],$data['perPage']);
        $engineers = $this->engineerService->paginate();
        return ApiResponse::success(EngineerResource::collection($engineers));
    }
    public function getEngineers(Request $request)
    {
        $engineers = $this->engineerService->getAll();
        return ApiResponse::success(EngineerResource::collection($engineers));
    }
    public function create(CreateEngineerRequest $request)
    {
        $data = EngineerDTO::fromCreateRequest($request->validated());
        $engineer = $this->engineerService->create($data);
        return ApiResponse::success(new EngineerResource($engineer), 'Engineer created successfully', 201);
    }
    public function show($id)
    {
        $engineer = $this->engineerService->show($id);
        return ApiResponse::success(new EngineerResource($engineer));
    }
    public function update(UpdateEngineerRequest $request, $id)
    {
        $data = EngineerDTO::fromUpdateRequest($request->validated());
        $updated = $this->engineerService->update($id, $data);

        if (!$updated) {
            return ApiResponse::error('Engineer not updated', 404);
        }
        return ApiResponse::success(null, 'Engineer updated successfully');
    }
    public function delete($id)
    {
        $deleted = $this->engineerService->delete($id);

        if (!$deleted) {
            return ApiResponse::error('Engineer not deleted', 404);
        }

        return ApiResponse::success(null, 'Engineer deleted successfully');
    }

}
