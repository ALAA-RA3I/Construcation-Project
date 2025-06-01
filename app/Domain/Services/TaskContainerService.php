<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\TaskContainerRepositoryInterface;
use App\Domain\Services\Contracts\TaskContainerServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class TaskContainerService implements TaskContainerServiceInterface
{
    protected $taskContainerRepo;

    public function __construct(TaskContainerRepositoryInterface $taskContainerRepo)
    {
        $this->taskContainerRepo = $taskContainerRepo;
    }

    public function getAll()
    {
        $this->taskContainerRepo->pushCriteria(new WithRelationsCriteria(['task', 'item']));
        return $this->taskContainerRepo->all();
    }

    public function paginate()
    {
        $this->taskContainerRepo->pushCriteria(new WithRelationsCriteria(['task', 'item']));
        return $this->taskContainerRepo->paginate();
    }

    public function create(array $data)
    {
        $taskContainer = $this->taskContainerRepo->create($data);
        return $taskContainer->load(['task', 'item']);
    }

    public function show($id)
    {
        $taskContainer = $this->taskContainerRepo->pushCriteria(new WithRelationsCriteria(['task', 'item']))->find($id);
        return $taskContainer;
    }

    public function update($id, array $data)
    {
        try {
            $taskContainer = $this->taskContainerRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('TaskContainer not found');
        }

        $this->taskContainerRepo->update($data, $id);
        return $taskContainer->fresh()->load(['task', 'item']);
    }

    public function delete($id)
    {
        return $this->taskContainerRepo->delete($id);
    }
}