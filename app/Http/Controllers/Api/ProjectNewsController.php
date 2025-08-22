<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectNewsDTO\ProjectNewsDTO;
use App\Domain\Services\Contracts\ProjectNewsServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectNews\CreateProjectNewsRequest;
use App\Http\Requests\ProjectNews\UpdateProjectNewsRequest;
use App\Http\Resources\ProjectNewsResource;
use Illuminate\Http\Request;

class ProjectNewsController extends Controller
{
    protected $projectNewsService;

    public function __construct(ProjectNewsServiceInterface $projectNewsService)
    {
        $this->projectNewsService = $projectNewsService;
    }

    public function index($projectId = null)
    {
        $projectNews = $this->projectNewsService->paginate($projectId);
        return ApiResponse::success(ProjectNewsResource::collection($projectNews));
    }

    public function getAll($projectId = null)
    {
        $projectNews = $this->projectNewsService->getAll($projectId);
        return ApiResponse::success(ProjectNewsResource::collection($projectNews));
    }

    public function show($id)
    {
        $projectNews = $this->projectNewsService->show($id);
        return ApiResponse::success(ProjectNewsResource::make($projectNews));
    }

    public function create(CreateProjectNewsRequest $data)
    {
        $validatedData = ProjectNewsDTO::fromCreateRequest($data->validated());
        $projectNews = $this->projectNewsService->create($validatedData);
        return ApiResponse::success(new ProjectNewsResource($projectNews));
    }

    public function update(UpdateProjectNewsRequest $data, $id)
    {
        $validatedData = ProjectNewsDTO::fromUpdateRequest($data->validated());
        $projectNews = $this->projectNewsService->update($id, $validatedData);
        if (!$projectNews)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectNewsResource($projectNews), 'Project News updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->projectNewsService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Project News deleted successfully');
    }
}
