<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\TaskDTO\TaskDTO;
use App\Domain\Services\Contracts\TaskServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {   
        $this->taskService = $taskService;
    }

    public function index() {
        $tasks = $this->taskService->paginate();
        return ApiResponse::success(TaskResource::collection($tasks));
    }

    public function getAll() {
        $tasks = $this->taskService->getAll();
        return ApiResponse::success(TaskResource::collection($tasks));
    }

    public function show($id) {
        $task = $this->taskService->show($id);
        return ApiResponse::success(TaskResource::make($task));
    }

    public function create(CreateTaskRequest $data) {
 
        $validatedData = TaskDTO::fromCreateRequest($data->validated());
        $task = $this->taskService->create($validatedData);
        return ApiResponse::success(new TaskResource($task));
    }

    public function update(UpdateTaskRequest $data, $id) {
        $validatedData = TaskDTO::fromUpdateRequest($data->validated());
        $task = $this->taskService->update($id, $validatedData);
        return ApiResponse::success(new TaskResource($task));
    }

    public function delete($id) {
        $deleted = $this->taskService->delete($id);

        if(!$deleted)
            return ApiResponse::error('Deletion failed', 400);

        return ApiResponse::success(null, 'Task deleted successfully');
    }
}
//https://mainnet.infura.io/v3/bf6cb3ab832641f8856dd37ed9a2cc9f
//bf6cb3ab832641f8856dd37ed9a2cc9f

// curl --url https://mainnet.infura.io/v3/bf6cb3ab832641f8856dd37ed9a2cc9f \
//   -X POST \
//   -H "Content-Type: application/json" \
//   -d '{"jsonrpc":"2.0","method":"eth_blockNumber","params":[],"id":1}'