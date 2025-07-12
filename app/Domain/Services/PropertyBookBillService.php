<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\PropertyBookBillRepositoryInterface;
use App\Domain\Services\Contracts\PropertyBookBillServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;

class PropertyBookBillService implements PropertyBookBillServiceInterface
{
    protected $propertyBookBillRepo;

    public function __construct(PropertyBookBillRepositoryInterface $propertyBookBillRepo)
    {
        $this->propertyBookBillRepo = $propertyBookBillRepo;
    }

    public function getAll()
    {
        $this->propertyBookBillRepo->pushCriteria(new WithRelationsCriteria(['propertyBook']));
        return $this->propertyBookBillRepo->all();
    }

    public function paginate()
    {
        $this->propertyBookBillRepo->pushCriteria(new WithRelationsCriteria(['propertyBook']));
        return $this->propertyBookBillRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $propertyBookBill = $this->propertyBookBillRepo->create($data);
            DB::commit();
            return $propertyBookBill->load(['propertyBook']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $propertyBookBill = $this->propertyBookBillRepo->pushCriteria(new WithRelationsCriteria(['propertyBook']))->find($id);
        return $propertyBookBill;
    }

    public function update($id, array $data)
    {
        try {
            $propertyBookBill = $this->propertyBookBillRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Property Book Bill not found');
        }

        $this->propertyBookBillRepo->update($data, $id);
        return $propertyBookBill->fresh()->load(['propertyBook']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $propertyBookBill = $this->propertyBookBillRepo->find($id);

            if (!$propertyBookBill) {
                return false;
            }

            // Soft delete the property book bill
            $propertyBookBill->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
