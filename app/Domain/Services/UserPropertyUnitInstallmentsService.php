<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WhereCriteria;
use App\Criteria\WithRelationsCriteria;
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
    public function getBillsByStatus($propertyUnitId, $isPaid)
    {
        $clientId = Auth::guard('api-client')->user()->id;

        return $this->userPropertyUnitInstallmentsRepo->scopeQuery(function ($query) use ($clientId, $propertyUnitId, $isPaid) {
            return $query->where('client_id', $clientId)
                ->where('property_unit_id', $propertyUnitId)
                ->where('is_paid', $isPaid)
                ->with(['propertyBookBill', 'propertyUnit']);
        })->all();
    }
    public function getClientInstallments($propertyUnitId, $clientId)
    {
        $this->userPropertyUnitInstallmentsRepo->pushCriteria(
            new WhereCriteria('property_unit_id', $propertyUnitId)
        );
        $this->userPropertyUnitInstallmentsRepo->pushCriteria(
            new WhereCriteria('client_id', $clientId)
        );
        $this->userPropertyUnitInstallmentsRepo->pushCriteria(
            new WithRelationsCriteria(['client', 'propertyUnit', 'propertyBookBill'])
        );

        return $this->userPropertyUnitInstallmentsRepo->all();
    }

}
