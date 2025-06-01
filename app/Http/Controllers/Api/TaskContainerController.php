<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\TaskContainerDTO\TaskContainerDTO;
use App\Domain\Services\Contracts\TaskContainerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskContainer\CreateTaskContainerRequest;
use App\Http\Requests\TaskContainer\UpdateTaskContainerRequest;
use App\Http\Resources\TaskContainerResource;

class TaskContainerController extends Controller
{
    protected $taskContainerService;

    public function __construct(TaskContainerServiceInterface $taskContainerService)
    {   
        $this->taskContainerService = $taskContainerService;
    }

    public function index() {
        $taskContainers = $this->taskContainerService->paginate();
        return ApiResponse::success(TaskContainerResource::collection($taskContainers));
    }

    public function getAll() {
        $taskContainers = $this->taskContainerService->getAll();
        return ApiResponse::success(TaskContainerResource::collection($taskContainers));
    }

    public function show($id) {
        $taskContainer = $this->taskContainerService->show($id);
        return ApiResponse::success(TaskContainerResource::make($taskContainer));
    }

    public function create(CreateTaskContainerRequest $data) {
        $validatedData = TaskContainerDTO::fromCreateRequest($data->validated());
        $taskContainer = $this->taskContainerService->create($validatedData);
        return ApiResponse::success(new TaskContainerResource($taskContainer));
    }

    public function update(UpdateTaskContainerRequest $data, $id) {
        $validatedData = TaskContainerDTO::fromUpdateRequest($data->validated());
        $taskContainer = $this->taskContainerService->update($id, $validatedData);
        if (!$taskContainer) 
            return ApiResponse::error('Something went wrong :(', 400);
        return ApiResponse::success(new TaskContainerResource($taskContainer), 'TaskContainer updated successfully');
    }

    public function delete($id) {
        $deleted = $this->taskContainerService->delete($id);

        if(!$deleted)
            return ApiResponse::error('Deletion failed', 400);
        return ApiResponse::success(null, 'TaskContainer deleted successfully');
    }
}