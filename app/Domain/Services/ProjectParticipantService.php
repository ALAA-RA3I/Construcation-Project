<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectParticipantRepositoryInterface;
use App\Domain\Services\Contracts\ProjectParticipantServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class ProjectParticipantService implements ProjectParticipantServiceInterface
{
    protected $projectParticipantRepo;

    public function __construct(ProjectParticipantRepositoryInterface $projectParticipantRepo)
    {
        $this->projectParticipantRepo = $projectParticipantRepo;
    }

    public function getAll()
    {
        $this->projectParticipantRepo->pushCriteria(new WithRelationsCriteria(['project', 'participant', 'projectFiles']));
        return $this->projectParticipantRepo->all();
    }

    public function paginate()
    {
        $this->projectParticipantRepo->pushCriteria(new WithRelationsCriteria(['project', 'participant', 'projectFiles']));
        return $this->projectParticipantRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->projectParticipantRepo->create($data);
    }

    public function show($id)
    {
        try {
            $this->projectParticipantRepo->pushCriteria(new WithRelationsCriteria(['project', 'participant', 'projectFiles']));
            return $this->projectParticipantRepo->find($id);
        } catch (ModelNotFoundException $exception) {
            throw new EntityNotFoundException();
        }
    }

    public function update($id, array $data)
    {
        try {
            return $this->projectParticipantRepo->update($data, $id);
        } catch (ModelNotFoundException $exception) {
            throw new EntityNotFoundException();
        }
    }

    public function delete($id)
    {
        try {
            return $this->projectParticipantRepo->delete($id);
        } catch (ModelNotFoundException $exception) {
            throw new EntityNotFoundException();
        }
    }
}