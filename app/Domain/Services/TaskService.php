<?php

namespace App\Domain\Services;

use App\Criteria\SortByStartDateCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Domain\Enums\TaskStatusEnum;
use App\Domain\Enums\TicketStatusEnum;
use App\Infrastructure\Repositories\Contracts\TaskRepositoryInterface;
use App\Domain\Services\Contracts\TaskServiceInterface;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use App\Domain\Enums\ApproveTaskEnum;
use App\Infrastructure\Repositories\Contracts\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
    public function changeStatus(array $data)
    {
        return DB::transaction(function () use ($data) {
            /** @var Task $task */
            $task = $data['task'];
            $user = $data['user'];
            $newStatus = $data['status'];

            $role = $user->getRoleNames()->first(); // assume you use spatie

            $currentStatus = $task->status;


            if ($role === 'engineer') {
                if ($currentStatus === TaskStatusEnum::ToDo && $newStatus === TaskStatusEnum::Doing) {
                    $task->status = $newStatus;
                } elseif ($currentStatus === TaskStatusEnum::Doing && $newStatus === TaskStatusEnum::PendingApproval) {
                    $task->status = $newStatus;
                } else {
                    throw new \Exception('Engineer not allowed to perform this transition');
                }

            } elseif ($role === 'consultingEngineer') {
                if ($currentStatus === TaskStatusEnum::PendingApproval && $newStatus === TaskStatusEnum::Done) {
                    $task->status = $newStatus;
                    $task->actual_date_of_closed = now();
                }
                else {
                    throw new \Exception('Consultant not allowed to perform this transition');
                }

            } else {
                throw new \Exception('Unauthorized role');
            }

            $task->save();

            return $task->fresh(['employeeAssigned', 'supervisor','ticket']);
        });
    }

//    public function markTaskAsDone($id) {
//        $task = $this->taskRepo->findOrFail($id);
//        if (!$task) {
//            return new ModelNotFoundException('Not Found');
//        }
//        $updatedData = [
//            'status_of_approval' => ApproveTaskEnum::Done,
//        ];
//        return $this->taskRepo->update($updatedData,$id);
//    }
//
//    public function markTaskAsRefuse(array $data ,$id) {
//        $task = $this->taskRepo->findOrFail($id);
//        if (!$task) {
//            return new ModelNotFoundException('Not Found');
//        }
//        $updatedData = [
//            'status_of_approval' => ApproveTaskEnum::WaitingForTicket,
//        ];
//        $this->taskRepo->update($updatedData,$id);
//        $data['task_id'] = $id;
//        return $this->ticketRepo->create($data);
//    }
//
//    public function markTaskAsDoneByExecutionEngineer($id) {
//        $task = $this->taskRepo->findOrFail($id);
//        if (!$task) {
//            return new ModelNotFoundException('Not Found');
//        }
//        $updatedData = [
//            'status_of_approval' => ApproveTaskEnum::WaitingApproval()->value,
//        ];
//        return $this->taskRepo->update($updatedData,$id);
//    }



}
