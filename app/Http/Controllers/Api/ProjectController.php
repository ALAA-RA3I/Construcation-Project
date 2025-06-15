<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectDTO\ProjectDTO;
use App\Domain\Services\Contracts\ProjectServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectServiceInterface $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index() {
        $projects = $this->projectService->paginate();
        return ApiResponse::success(ProjectResource::collection($projects));
    }

    public function getAll()
    {
        $projects = $this->projectService->getAll();
        return ApiResponse::success(ProjectResource::collection($projects));
    }

    public function show($id)
    {
        $project = $this->projectService->show($id);
        return ApiResponse::success(ProjectResource::make($project));
    }

    public function create(CreateProjectRequest $data)
    {
        $validatedData = ProjectDTO::fromCreateRequest($data->validated());
        $project = $this->projectService->create($validatedData);
        return ApiResponse::success(new ProjectResource($project));
    }

    public function update(UpdateProjectRequest $data, $id)
    {
        $validatedData = ProjectDTO::fromUpdateRequest($data->validated());
        $project = $this->projectService->update($id, $validatedData);
        if (!$project)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectResource($project), 'Project updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->projectService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Project deleted successfully');
    }
}
