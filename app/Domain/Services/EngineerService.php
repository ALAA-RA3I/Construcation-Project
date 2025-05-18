<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\EngineerRepositoryInterface;
use App\Domain\Services\Contracts\EngineerServiceInterface;

class EngineerService implements EngineerServiceInterface
{
    protected $engineerRepo;

    public function __construct(EngineerRepositoryInterface $engineerRepo)
    {
        $this->engineerRepo = $engineerRepo;
    }

    public function getAll(array $filters = [], $search = null)
    {
        $searchColumns = ['user.first_name','user.last_name','user.email','user.phone_number','years_of_experience','specialization.name_of_major'];
        $this->engineerRepo->pushCriteria(new AdvancedDynamicFilterSearchCriteria($filters, $search, $searchColumns));
        $this->engineerRepo->pushCriteria(new WithRelationsCriteria(['user','specialization']));
        return $this->engineerRepo->all();
    }

    public function paginate(array $filters = [], $search = null, $perPage = 10)
    {
        $searchColumns = ['user.first_name','user.last_name','user.email','user.phone_number','years_of_experience','specialization.name_of_major'];
        $this->engineerRepo->pushCriteria(new AdvancedDynamicFilterSearchCriteria($filters, $search, $searchColumns));
        $this->engineerRepo->pushCriteria(new WithRelationsCriteria(['user','specialization']));
        return $this->engineerRepo->paginate($perPage);
    }

    public function create(array $data)
    {
        return $this->engineerRepo->create($data);
    }

    public function show($id)
    {
        return $this->engineerRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->engineerRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->engineerRepo->delete($id);
    }
}
