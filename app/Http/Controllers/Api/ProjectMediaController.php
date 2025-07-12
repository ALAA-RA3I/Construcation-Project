<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectMediaDTO\ProjectMediaDTO;
use App\Domain\Services\Contracts\ProjectMediaServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectMedia\CreateProjectMediaRequest;
use App\Http\Requests\ProjectMedia\UpdateProjectMediaRequest;
use App\Http\Resources\ProjectMediaResource;
use Illuminate\Http\Request;

class ProjectMediaController extends Controller
{
    protected $projectMediaService;

    public function __construct(ProjectMediaServiceInterface $projectMediaService)
    {
        $this->projectMediaService = $projectMediaService;
    }

    public function index()
    {
        $projectMedia = $this->projectMediaService->paginate();
        return ApiResponse::success(ProjectMediaResource::collection($projectMedia));
    }

    public function getAll()
    {
        $projectMedia = $this->projectMediaService->getAll();
        return ApiResponse::success(ProjectMediaResource::collection($projectMedia));
    }

    public function show($id)
    {
        $projectMedia = $this->projectMediaService->show($id);
        return ApiResponse::success(ProjectMediaResource::make($projectMedia));
    }

    public function create(CreateProjectMediaRequest $data)
    {
        $validatedData = ProjectMediaDTO::fromCreateRequest($data->validated());
        $projectMedia = $this->projectMediaService->create($validatedData);
        return ApiResponse::success(new ProjectMediaResource($projectMedia));
    }

    public function update(UpdateProjectMediaRequest $data, $id)
    {
        $validatedData = ProjectMediaDTO::fromUpdateRequest($data->validated());
        $projectMedia = $this->projectMediaService->update($id, $validatedData);
        if (!$projectMedia)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectMediaResource($projectMedia), 'Project Media updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->projectMediaService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'Project Media deleted successfully');
    }
}
