<?php

namespace App\Domain\Services;

use App\Criteria\SortByStartDateCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\TaskRepositoryInterface;
use App\Domain\Services\Contracts\TaskServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use App\Domain\Enums\ApproveTaskEnum;
use App\Infrastructure\Repositories\Contracts\TicketRepositoryInterface;

class TaskService implements TaskServiceInterface
{
    protected $taskRepo;
    protected $ticketRepo;

    public function __construct(
        TaskRepositoryInterface $taskRepo,
        TicketRepositoryInterface $ticketRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->ticketRepo = $ticketRepo;
    }

    public function getAll($stageId)
    {
        $this->taskRepo->pushCriteria(new WithRelationsCriteria(['stage', 'employeeAssigned.participant.user', 'supervisor', 'taskContainer', 'ticket']));
        $this->taskRepo->pushCriteria(new \App\Criteria\StageCriteria($stageId));
        $this->taskRepo->pushCriteria(new \App\Criteria\SortByStartDateCriteria());


        return $this->taskRepo->all();
    }

    public function paginate($stageId)
    {
        $this->taskRepo->pushCriteria(new WithRelationsCriteria(['stage', 'employeeAssigned.participant.user', 'supervisor', 'taskContainer', 'ticket']));
        $this->taskRepo->pushCriteria(new \App\Criteria\StageCriteria($stageId));
        $this->taskRepo->pushCriteria(new \App\Criteria\SortByStartDateCriteria());
        return $this->taskRepo->paginate();
    }

    public function create(array $data)
    {

        $task = $this->taskRepo->create($data);
        return $task->load(['stage', 'employeeAssigned.participant.user', 'supervisor', 'taskContainer', 'ticket']);
    }

    public function show($id)
    {
        $task = $this->taskRepo->pushCriteria(new WithRelationsCriteria(['stage', 'employeeAssigned.participant.user', 'supervisor', 'taskContainer', 'ticket']))->find($id);
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
        return $task->fresh()->load(['stage', 'employeeAssigned.participant.user', 'supervisor', 'taskContainer', 'ticket']);
    }

    public function delete($id)
    {
        return $this->taskRepo->delete($id);
    }
    public function markTaskAsDone($id) {
        $task = $this->taskRepo->findOrFail($id);
        if (!$task) {
            return new ModelNotFoundException('Not Found');
        }
        $updatedData = [
            'status_of_approval' => ApproveTaskEnum::Done,
        ];      
        return $this->taskRepo->update($updatedData,$id);
    }

    public function markTaskAsRefuse(array $data ,$id) {
        $task = $this->taskRepo->findOrFail($id);
        if (!$task) {
            return new ModelNotFoundException('Not Found');
        }
        $updatedData = [
            'status_of_approval' => ApproveTaskEnum::WaitingForTicket,
        ];      
        $this->taskRepo->update($updatedData,$id);
        $data['task_id'] = $id;
        return $this->ticketRepo->create($data);
    }

    public function markTaskAsDoneByExecutionEngineer($id) {
        $task = $this->taskRepo->findOrFail($id);
        if (!$task) {
            return new ModelNotFoundException('Not Found');
        }
        $updatedData = [
            'status_of_approval' => ApproveTaskEnum::WaitingApproval()->value,
        ];      
        return $this->taskRepo->update($updatedData,$id);
    }


}