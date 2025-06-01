<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectStageDTO\ProjectStageDTO;
use App\Domain\Services\Contracts\ProjectStageServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectStage\CreateProjectStageRequest;
use App\Http\Requests\ProjectStage\UpdateProjectStageRequest;
use App\Http\Resources\ProjectStageResource;
use Illuminate\Http\Request;

class ProjectStageController extends Controller
{
    protected $projectStageService;

    public function __construct(ProjectStageServiceInterface $projectStageService)
    {   
        $this->projectStageService = $projectStageService;
    }

    public function index() {
        $projectStages = $this->projectStageService->paginate();
        return ApiResponse::success(ProjectStageResource::collection($projectStages));
    }

    public function getAll() {
        $projectStages = $this->projectStageService->getAll();
        return ApiResponse::success(ProjectStageResource::collection($projectStages));
    }

    public function show($id) {
        $projectStage = $this->projectStageService->show($id);
        return ApiResponse::success(ProjectStageResource::make($projectStage));
    }

    public function create(CreateProjectStageRequest $data) {
        $validatedData = ProjectStageDTO::fromCreateRequest($data->validated());
        $projectStage = $this->projectStageService->create($validatedData);
        return ApiResponse::success(new ProjectStageResource($projectStage));
    }

    public function update(UpdateProjectStageRequest $data, $id) {
        $validatedData = ProjectStageDTO::fromUpdateRequest($data->validated());
        $projectStage = $this->projectStageService->update($id, $validatedData);
        if (!$projectStage) 
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectStageResource($projectStage), 'Project Stage updated successfully');
    }

    public function delete($id) {
        $deleted = $this->projectStageService->delete($id);

        if(!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Project Stage deleted successfully');
    }
}