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

    public function getAll($projectId)
    {
        $this->projectStageRepo->pushCriteria(new WithRelationsCriteria([ 'task.employeeAssigned.participant.user']));
    $this->projectStageRepo->pushCriteria(new \App\Criteria\ProjectCriteria($projectId)); 
        return $this->projectStageRepo->all();
    }

    public function paginate($projectId)
    {
        $this->projectStageRepo->pushCriteria(new WithRelationsCriteria([ 'task.employeeAssigned.participant.user']));
    $this->projectStageRepo->pushCriteria(new \App\Criteria\ProjectCriteria($projectId)); 

        return $this->projectStageRepo->paginate();
    }

    public function create(array $data)
    {
        $projectStage = $this->projectStageRepo->create($data);
        return $projectStage->load(['project', 'task.employeeAssigned.participant.user']);
    }

    public function show($id)
    {
        $projectStage = $this->projectStageRepo->pushCriteria(new WithRelationsCriteria([ 'task.employeeAssigned.participant.user']))->find($id);
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
        return $projectStage->fresh()->load([ 'task.employeeAssigned.participant.user']);
    }

    public function delete($id)
    {
        return $this->projectStageRepo->delete($id);
    }
}