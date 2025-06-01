<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\TaskRepositoryInterface;
use App\Domain\Services\Contracts\TaskServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class TaskService implements TaskServiceInterface
{
    protected $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
    }

    public function getAll()
    {
        $this->taskRepo->pushCriteria(new WithRelationsCriteria(['stage', 'employeeAssigned', 'supervisor', 'taskContainer', 'ticket']));
        return $this->taskRepo->all();
    }

    public function paginate()
    {
        $this->taskRepo->pushCriteria(new WithRelationsCriteria(['stage', 'employeeAssigned', 'supervisor', 'taskContainer', 'ticket']));
        return $this->taskRepo->paginate();
    }

    public function create(array $data)
    {
        $task = $this->taskRepo->create($data);
        return $task->load(['stage', 'employeeAssigned', 'supervisor', 'taskContainer', 'ticket']);
    }

    public function show($id)
    {
        $task = $this->taskRepo->pushCriteria(new WithRelationsCriteria(['stage', 'employeeAssigned', 'supervisor', 'taskContainer', 'ticket']))->find($id);
        return $task;
    }

    public function update($id, array $data)
    {
        try {
            $task = $this->taskRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Task not found');
        }

        $this->taskRepo->update($data, $id);
        return $task->fresh()->load(['stage', 'employeeAssigned', 'supervisor', 'taskContainer', 'ticket']);
    }

    public function delete($id)
    {
        return $this->taskRepo->delete($id);
    }
}