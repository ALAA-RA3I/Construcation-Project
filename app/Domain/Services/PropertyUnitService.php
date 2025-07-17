<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\PropertyUnitRepositoryInterface;
use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class PropertyUnitService implements PropertyUnitServiceInterface
{
    protected $propertyUnitRepo;

    public function __construct(PropertyUnitRepositoryInterface $propertyUnitRepo)
    {
        $this->propertyUnitRepo = $propertyUnitRepo;
    }

    public function getAll()
    {
        $this->propertyUnitRepo->pushCriteria(new WithRelationsCriteria(['propertyBook']));
        return $this->propertyUnitRepo->all();
    }

    public function paginate()
    {
        $this->propertyUnitRepo->pushCriteria(new WithRelationsCriteria(['propertyBook']));
        return $this->propertyUnitRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $propertyUnit = $this->propertyUnitRepo->create($data);
            DB::commit();
            return $propertyUnit->load(['propertyBook']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $propertyUnit = $this->propertyUnitRepo->pushCriteria(new WithRelationsCriteria(['propertyBook']))->find($id);
        return $propertyUnit;
    }

    public function update($id, array $data)
    {
        try {
            $propertyUnit = $this->propertyUnitRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Property Unit not found');
        }

        $this->propertyUnitRepo->update($data, $id);
        return $propertyUnit->fresh()->load(['propertyBook']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $propertyUnit = $this->propertyUnitRepo->find($id);

            if (!$propertyUnit) {
                return false;
            }

            $propertyUnit->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public function getProjectsOfClient($clientId)
    {
        return $this->propertyUnitRepo
            ->with([
                'propertyBook.project.salesDetails'
            ])
            ->findWhere([
                'client_id' => $clientId
            ]);
    }
    public function getProjectDetailsByPropertyUnit($propertyUnitId)
    {
        return $this->propertyUnitRepo
            ->with([
                'propertyBook.project.salesDetails',
            ])
            ->find($propertyUnitId);
    }
    public function getClientProjectNews($clientId)
    {
        $propertyUnits = $this->propertyUnitRepo
            ->with(['propertyBook.project.salesDetails', 'propertyBook.project.projectNews'])
            ->scopeQuery(function($query) use ($clientId) {
                return $query->where('client_id', $clientId);
            })->all();

        $news = new Collection();

        foreach ($propertyUnits as $unit) {
            $projectNews = optional($unit->propertyBook->project)->projectNews ?? collect();
            $news = $news->merge($projectNews);
        }

    return $news->load('project.salesDetails')->unique('id')->values();
    }
}
