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

    public function getAll()
    {
        return $this->userRepo->all();
    }

    public function paginate()
    {
        return $this->userRepo->paginate();
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
