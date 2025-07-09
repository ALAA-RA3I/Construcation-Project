<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\PropertyBookRepositoryInterface;
use App\Domain\Services\Contracts\PropertyBookServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;

class PropertyBookService implements PropertyBookServiceInterface
{
    protected $propertyBookRepo;

    public function __construct(PropertyBookRepositoryInterface $propertyBookRepo)
    {
        $this->propertyBookRepo = $propertyBookRepo;
    }

    public function getAll()
    {
        $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->propertyBookRepo->all();
    }

    public function paginate()
    {
        $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->propertyBookRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $propertyBook = $this->propertyBookRepo->create($data);
            DB::commit();
            return $propertyBook->load(['project']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $propertyBook = $this->propertyBookRepo->pushCriteria(new WithRelationsCriteria(['project']))->find($id);
        return $propertyBook;
    }

    public function update($id, array $data)
    {
        try {
            $propertyBook = $this->propertyBookRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Property Book not found');
        }

        $this->propertyBookRepo->update($data, $id);
        return $propertyBook->fresh()->load(['project']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $propertyBook = $this->propertyBookRepo->find($id);

            if (!$propertyBook) {
                return false;
            }

            // Soft delete the property book
            $propertyBook->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
} 