<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ConsultingEngineerDTO\ConsultingEngineerDTO;
use App\Domain\Services\Contracts\ConsultingEngineerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultingEngineer\CreateConsultingEngineerRequest;
use App\Http\Requests\ConsultingEngineer\UpdateConsultingEngineerRequest;
use App\Http\Resources\ConsultingEngineerResource;
use Illuminate\Http\Request;

class ConsultingEngineerController extends Controller
{
    private  $engineerService ;

    public function __construct(ConsultingEngineerServiceInterface $service)
    {
        $this->engineerService = $service;
    }
    public function index()
    {
        $engineers = $this->engineerService->paginate();
        return ApiResponse::success(ConsultingEngineerResource::collection($engineers));
    }
    public function getAll(Request $request)
    {
        $engineers = $this->engineerService->getAll();
        return ApiResponse::success(ConsultingEngineerResource::collection($engineers));
    }
    public function create(CreateConsultingEngineerRequest $request)
    {
        $data = ConsultingEngineerDTO::fromCreateRequest($request->validated());
        $engineer = $this->engineerService->create($data);
        return ApiResponse::success(new ConsultingEngineerResource($engineer), 'Engineer created successfully', 201);
    }
    public function show($id)
    {
        $engineer = $this->engineerService->show($id);
        return ApiResponse::success(new ConsultingEngineerResource($engineer));
    }
    public function update(UpdateConsultingEngineerRequest $request, $id)
    {
        $data = ConsultingEngineerDTO::fromUpdateRequest($request->validated());
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
