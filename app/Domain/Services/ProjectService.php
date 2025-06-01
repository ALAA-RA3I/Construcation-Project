<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectRepositoryInterface;
use App\Domain\Services\Contracts\ProjectServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class ProjectService implements ProjectServiceInterface
{
    protected $projectRepo;

    public function __construct(ProjectRepositoryInterface $projectRepo)
    {
        $this->projectRepo = $projectRepo;
    }

    public function getAll()
    {
        $this->projectRepo->pushCriteria(new WithRelationsCriteria(['owners', 'consultingCompany']));
        return $this->projectRepo->all();
    }

    public function paginate()
    {
        $this->projectRepo->pushCriteria(new WithRelationsCriteria(['owners', 'consultingCompany']));
        return $this->projectRepo->paginate();
    }

    public function create(array $data)
    {
        $project = $this->projectRepo->create($data);
        return $project->load(['owners', 'consultingCompany']);
    }

    public function show($id)
    {
        $project = $this->projectRepo->pushCriteria(new WithRelationsCriteria(['owners', 'consultingCompany']))->find($id);
        return $project;
    }

    public function update($id, array $data)
    {
        try {
            $project = $this->projectRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project not found');
        }

        $this->projectRepo->update($data, $id);
        return $project->fresh()->load(['owners', 'consultingCompany']);
    }

    public function delete($id)
    {
        return $this->projectRepo->delete($id);
    }
}