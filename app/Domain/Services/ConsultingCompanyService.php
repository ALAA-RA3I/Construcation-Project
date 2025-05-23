<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\ConsultingCompanyRepositoryInterface;
use App\Domain\Services\Contracts\ConsultingCompanyServiceInterface;

class ConsultingCompanyService implements ConsultingCompanyServiceInterface
{
    protected $consultingCompanyRepo;

    public function __construct(ConsultingCompanyRepositoryInterface $consultingCompanyRepo)
    {
        $this->consultingCompanyRepo = $consultingCompanyRepo;
    }

    public function getAll()
    {
        return $this->consultingCompanyRepo->all();
    }

    public function paginate()
    {
        return $this->consultingCompanyRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->consultingCompanyRepo->create($data);
    }

    public function show($id)
    {
        return $this->consultingCompanyRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->consultingCompanyRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->consultingCompanyRepo->delete($id);
    }
}