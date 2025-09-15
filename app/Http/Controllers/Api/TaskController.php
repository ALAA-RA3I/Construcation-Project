<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\TaskDTO\TaskDTO;
use App\Application\DTO\TicketDTO\TicketDTO;
use App\Domain\Services\Contracts\TaskServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\ChangeTaskStatusRequest;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TicketResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index($stageId) {
        $tasks = $this->taskService->paginate($stageId);
        return ApiResponse::success(TaskResource::collection($tasks));
    }

    public function getAll($stageId) {
        $tasks = $this->taskService->getAll($stageId);
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

    public function changeStatus(ChangeTaskStatusRequest $request, Task $task)
    {
        $data = TaskDTO::fromChangeStatusRequest($request->validated(), $task);
        $task = $this->taskService->changeStatus($data);

        return ApiResponse::success(new TaskResource($task), 'Task status updated successfully');
    }
//    public function markTaskAsDone($id) {
//        $this->taskService->markTaskAsDone($id);
//        return ApiResponse::success(null, 'Status of task has been changed successfully');
//    }
//
//    public function markTaskAsDoneByExecutionEngineer($id) {
//        $this->taskService->markTaskAsDoneByExecutionEngineer($id);
//        return ApiResponse::success(null, 'Status of task has been changed successfully');
//    }
//
//    public function refuseTask(CreateTicketRequest $request,$id) {
//        $validatedData = TicketDTO::fromCreateRequest($request->validated());
//        $ticket = $this->taskService->markTaskAsRefuse($validatedData,$id);
//        return ApiResponse::success(TicketResource::make($ticket),'Ticket Status has been updated successfully');
//    }
}
