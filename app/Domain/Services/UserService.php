<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers($filters = [], $search = null)
    {
        $searchColumns = ['name', 'email', 'employee.position', 'employee.visits.reason'];

        $this->userRepo->pushCriteria(
            new AdvancedDynamicFilterSearchCriteria($filters, $search, $searchColumns)
        );

        return $this->userRepo->with(['employee.visits'])->all();
    }
    public function create(array $data)
    {
        return $this->userRepo->create($data);
    }

    public function show($id)
    {
        return $this->userRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->userRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userRepo->delete($id);
    }
}
