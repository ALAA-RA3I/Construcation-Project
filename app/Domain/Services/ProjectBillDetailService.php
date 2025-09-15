<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectBillDetailRepositoryInterface;
use App\Domain\Services\Contracts\ProjectBillDetailServiceInterface;

class ProjectBillDetailService implements ProjectBillDetailServiceInterface
{
    protected $projectBillDetailRepo;

    public function __construct(ProjectBillDetailRepositoryInterface $projectBillDetailRepo)
    {
        $this->projectBillDetailRepo = $projectBillDetailRepo;
    }

    public function getAll()
    {
        return $this->projectBillDetailRepo->all();
    }

    public function paginate()
    {
        return $this->projectBillDetailRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->projectBillDetailRepo->create($data);
    }

    public function show($id)
    {
        return $this->projectBillDetailRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->projectBillDetailRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->projectBillDetailRepo->delete($id);
    }
}