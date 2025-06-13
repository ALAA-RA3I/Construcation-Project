<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectManager\ProjectManagerDTO;
use App\Domain\Services\Contracts\ProjectManagerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectManager\CreateProjectManager;
use App\Http\Requests\ProjectManager\UpdateProjectManager;
use App\Http\Resources\ProjectManagerResource;
use Illuminate\Http\Request;

class ProjectManagerController extends Controller
{
    private  $managerService ;

    public function __construct(ProjectManagerServiceInterface $service)
    {
        $this->managerService = $service;
    }
    public function index()
    {
        $engineers = $this->managerService->paginate();
        return ApiResponse::success(ProjectManagerResource::collection($engineers));
    }
    public function getAll(Request $request)
    {
        $engineers = $this->managerService->getAll();
        return ApiResponse::success(ProjectManagerResource::collection($engineers));
    }
    public function create(CreateProjectManager $request)
    {
        $data = ProjectManagerDTO::fromCreateRequest($request->validated());
        $engineer = $this->managerService->create($data);
        return ApiResponse::success(new ProjectManagerResource($engineer), 'Project Manager created successfully', 201);
    }
    public function show($id)
    {
        $engineer = $this->managerService->show($id);
        return ApiResponse::success(new ProjectManagerResource($engineer));
    }
    public function update(UpdateProjectManager $request, $id)
    {
        $data = ProjectManagerDTO::fromUpdateRequest($request->validated());
        $updated = $this->managerService->update($id, $data);

        if (!$updated) {
            return ApiResponse::error('Engineer not updated', 404);
        }
        return ApiResponse::success(null, 'Project Manager updated successfully');
    }
    public function delete($id)
    {
        $deleted = $this->managerService->delete($id);

        if (!$deleted) {
            return ApiResponse::error('Project Manager not deleted', 404);
        }

        return ApiResponse::success(null, 'Project Manager deleted successfully');
    }
}
