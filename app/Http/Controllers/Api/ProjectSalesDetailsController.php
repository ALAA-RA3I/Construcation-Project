<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectSalesDetailsDTO\ProjectSalesDetailsDTO;
use App\Domain\Services\Contracts\ProjectSalesDetailsServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectSalesDetails\CreateProjectSalesDetailsRequest;
use App\Http\Requests\ProjectSalesDetails\UpdateProjectSalesDetailsRequest;
use App\Http\Resources\ProjectSalesDetailsResource;
use Illuminate\Http\Request;

class ProjectSalesDetailsController extends Controller
{
    protected $projectSalesDetailsService;

    public function __construct(ProjectSalesDetailsServiceInterface $projectSalesDetailsService)
    {
        $this->projectSalesDetailsService = $projectSalesDetailsService;
    }

    public function index()
    {
        $projectSalesDetails = $this->projectSalesDetailsService->paginate();
        return ApiResponse::success(ProjectSalesDetailsResource::collection($projectSalesDetails));
    }

    public function getAll()
    {
        $projectSalesDetails = $this->projectSalesDetailsService->getAll();
        return ApiResponse::success(ProjectSalesDetailsResource::collection($projectSalesDetails));
    }

    public function show($id)
    {
        $projectSalesDetails = $this->projectSalesDetailsService->show($id);
        return ApiResponse::success(ProjectSalesDetailsResource::make($projectSalesDetails));
    }

    public function create(CreateProjectSalesDetailsRequest $data)
    {
        $validatedData = ProjectSalesDetailsDTO::fromCreateRequest($data->validated());
        $projectSalesDetails = $this->projectSalesDetailsService->create($validatedData);
        return ApiResponse::success(new ProjectSalesDetailsResource($projectSalesDetails));
    }

    public function update(UpdateProjectSalesDetailsRequest $data, $id)
    {
        $validatedData = ProjectSalesDetailsDTO::fromUpdateRequest($data->validated());
        $projectSalesDetails = $this->projectSalesDetailsService->update($id, $validatedData);
        if (!$projectSalesDetails)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectSalesDetailsResource($projectSalesDetails), 'Project Sales Details updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->projectSalesDetailsService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Project Sales Details deleted successfully');
    }
}
