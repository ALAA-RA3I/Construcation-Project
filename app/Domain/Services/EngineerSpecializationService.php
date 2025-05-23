<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\EngineerSpecializationRepositoryInterface;
use App\Domain\Services\Contracts\EngineerSpecializationServiceInterface;

class EngineerSpecializationService implements EngineerSpecializationServiceInterface
{
    protected $engineerSpecializationRepo;

    public function __construct(EngineerSpecializationRepositoryInterface $engineerSpecializationRepo)
    {
        $this->engineerSpecializationRepo = $engineerSpecializationRepo;
    }

    public function getAll()
    {
        return $this->engineerSpecializationRepo->all();
    }

    public function paginate()
    {
        return $this->engineerSpecializationRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->engineerSpecializationRepo->create($data);
    }

    public function show($id)
    {
        return $this->engineerSpecializationRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->engineerSpecializationRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->engineerSpecializationRepo->delete($id);
    }
}
