<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Infrastructure\Repositories\Contracts\UserPropertyUnitInstallmentsRepositoryInterface;
use App\Domain\Services\Contracts\UserPropertyUnitInstallmentsServiceInterface;
// use Illuminate\Fa\Attributes\Auth;
use Illuminate\Support\Facades\Auth;

class UserPropertyUnitInstallmentsService implements UserPropertyUnitInstallmentsServiceInterface
{
    protected $userPropertyUnitInstallmentsRepo;

    public function __construct(UserPropertyUnitInstallmentsRepositoryInterface $userPropertyUnitInstallmentsRepo)
    {
        $this->userPropertyUnitInstallmentsRepo = $userPropertyUnitInstallmentsRepo;
    }

    public function getAll()
    {
        $clientId = Auth::guard('api-client')->user()->id;
        $bills = $this->userPropertyUnitInstallmentsRepo->scopeQuery(function ($query) use ($clientId) {
        return $query->where('client_id', $clientId)->with(['propertyBookBill','propertyUnit']);
        })->all();

        return $bills;
    }

    public function paginate()
    {
        return $this->userPropertyUnitInstallmentsRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->userPropertyUnitInstallmentsRepo->create($data);
    }

    public function show($id)
    {
        return $this->userPropertyUnitInstallmentsRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->userPropertyUnitInstallmentsRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->userPropertyUnitInstallmentsRepo->delete($id);
    }
}