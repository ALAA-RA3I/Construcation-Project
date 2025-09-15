<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectParticipantDTO\ProjectParticipantDTO;
use App\Domain\Services\Contracts\ProjectParticipantServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectParticipant\CreateProjectParticipantRequest;
use App\Http\Requests\ProjectParticipant\UpdateProjectParticipantRequest;
use App\Http\Resources\ProjectParticipantResource;
use Illuminate\Http\Request;

class ProjectParticipantController extends Controller
{
    protected $projectParticipantService;

    public function __construct(ProjectParticipantServiceInterface $projectParticipantService)
    {
        $this->projectParticipantService = $projectParticipantService;
    }

    public function index()
    {
        $projectParticipants = $this->projectParticipantService->paginate();
        return ApiResponse::success(ProjectParticipantResource::collection($projectParticipants));
    }

    public function getAll()
    {
        $projectParticipants = $this->projectParticipantService->getAll();
        return ApiResponse::success(ProjectParticipantResource::collection($projectParticipants));
    }

    public function show($id)
    {
        $projectParticipant = $this->projectParticipantService->show($id);
        if (!$projectParticipant)
            return ApiResponse::error('Project Participant not found', 404);
        return ApiResponse::success(new ProjectParticipantResource($projectParticipant));
    }

    public function create(CreateProjectParticipantRequest $request)
    {
        $validatedData = ProjectParticipantDTO::fromCreateRequest($request->validated());
        $projectParticipant = $this->projectParticipantService->create($validatedData);
        if (!$projectParticipant)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectParticipantResource($projectParticipant), 'Project Participant created successfully');
    }

    public function update(UpdateProjectParticipantRequest $request, $id)
    {
        $validatedData = ProjectParticipantDTO::fromUpdateRequest($request->validated());
        $projectParticipant = $this->projectParticipantService->update($id, $validatedData);
        if (!$projectParticipant)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new ProjectParticipantResource($projectParticipant), 'Project Participant updated successfully');
    }

    public function delete($id)
    {
        $deleted = $this->projectParticipantService->delete($id);

        if (!$deleted)
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(null, 'Project Participant deleted successfully');
    }
}
