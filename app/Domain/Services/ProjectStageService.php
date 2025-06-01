<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectStageRepositoryInterface;
use App\Domain\Services\Contracts\ProjectStageServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class ProjectStageService implements ProjectStageServiceInterface
{
    protected $projectStageRepo;

    public function __construct(ProjectStageRepositoryInterface $projectStageRepo)
    {
        $this->projectStageRepo = $projectStageRepo;
    }

    public function getAll()
    {
        $this->projectStageRepo->pushCriteria(new WithRelationsCriteria(['project', 'task']));
        return $this->projectStageRepo->all();
    }

    public function paginate()
    {
        $this->projectStageRepo->pushCriteria(new WithRelationsCriteria(['project', 'task']));
        return $this->projectStageRepo->paginate();
    }

    public function create(array $data)
    {
        $projectStage = $this->projectStageRepo->create($data);
        return $projectStage->load(['project', 'task']);
    }

    public function show($id)
    {
        $projectStage = $this->projectStageRepo->pushCriteria(new WithRelationsCriteria(['project', 'task']))->find($id);
        return $projectStage;
    }

    public function update($id, array $data)
    {
        try {
            $projectStage = $this->projectStageRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project Stage not found');
        }

        $this->projectStageRepo->update($data, $id);
        return $projectStage->fresh()->load(['project', 'task']);
    }

    public function delete($id)
    {
        return $this->projectStageRepo->delete($id);
    }
}