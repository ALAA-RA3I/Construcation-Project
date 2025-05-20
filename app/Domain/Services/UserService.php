<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use App\Domain\Services\Contracts\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAll(array $filters = [], $search = null)
    {
        $searchColumns = ['first_name'];
        $this->userRepo->pushCriteria(new AdvancedDynamicFilterSearchCriteria($filters, $search, $searchColumns));
        return $this->userRepo->all();
    }

    public function paginate(array $filters = [], $search = null, $perPage = 10)
    {
        $searchColumns = ['first_name'];
        $this->userRepo->pushCriteria(new AdvancedDynamicFilterSearchCriteria($filters, $search, $searchColumns));
        return $this->userRepo->paginate($perPage);
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
