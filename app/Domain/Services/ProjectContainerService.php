<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WhereCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectContainerRepositoryInterface;
use App\Domain\Services\Contracts\ProjectContainerServiceInterface;
use App\Infrastructure\Repositories\Contracts\ItemRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;


class ProjectContainerService implements ProjectContainerServiceInterface
{
    protected $projectContainerRepo;
    protected $projectRepo;
    protected $itemRepo;

    public function __construct(
        ProjectContainerRepositoryInterface $projectContainerRepo,
        ProjectRepositoryInterface $projectRepo,
        ItemRepositoryInterface $itemRepo)
    {
        $this->projectContainerRepo = $projectContainerRepo;
        $this->projectRepo = $projectRepo;
        $this->itemRepo = $itemRepo;
    }

    public function getAll($id)
    {
        return $this->projectContainerRepo->findWhere(['project_id' => $id]);
    }
    public function paginate()
    {
        return $this->projectContainerRepo->paginate();
    }

    public function createIfNotExisit(array $data,$id)
    {
        return DB::transaction(function () use ($data, $id) {
            try {
                $project = $this->projectRepo->findOrFail($id);
                $itemData = Arr::only($data, [
                    'name',
                    'category',
                    'unit',
                ]);
                $item = $this->itemRepo->create($itemData);
                $projectContainerData = Arr::only($data, [
                    'expected_quantity',
                ]);
                $projectContainerData['project_id'] = $project->id;
                $projectContainerData['items_id'] = $item->id;
                $itemCreated = $this->projectContainerRepo->create($projectContainerData);
            }
            catch(ModelNotFoundException $e) {
                return $e->getMessage();
            }
            return $itemCreated;
        });
    }

    public function createIfExisit(array $data,$id) {
        try {
            $project = $this->projectRepo->findOrFail($id);
            $item = $this->itemRepo->findOrFail($data['items_id']);

            $data['project_id'] = $project->id;
            $data['items_id'] = $item->id;

            return $this->projectContainerRepo->create($data);
        } catch (ModelNotFoundException $e) {
            Log::error("Project or Item not found", [
                'projectID' => $id,
                'itemID' => $item->id,
            ]);
            throw $e; // أو رجع response مناسب
        }
    }

    public function show($id)
    {
        return $this->projectContainerRepo->find($id);
    }

    public function update( array $data,$id)
    {
        return $this->projectContainerRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->projectContainerRepo->delete($id);
    }
    public function getProjectContainerReports($id)
    {
        return $this->projectContainerRepo
            ->pushCriteria(new WithRelationsCriteria(['items']))
            ->findWhere(['project_id' => $id]);
    }
    public function getProjectWareHouse($id)
    {
        return $this->projectContainerRepo
            ->pushCriteria(new WithRelationsCriteria(['items']))
            ->findWhere([
                ['project_id', '=', $id],
                ['quantity_available', '>', 0],
            ]);
    }
    public function addItemsToWarehouse($projectId,  $data)
    {
        foreach ($data['items'] as $item) {
            // التحقق من وجود السطر الحالي
            $existing = $this->projectContainerRepo
                ->findWhere([
                    ['project_id', '=', $projectId],
                    ['items_id', '=', $item['item_id']]
                ])->first();

            if ($existing) {
                // التحديث
                $this->projectContainerRepo->update([
                    'quantity_available' => $existing->quantity_available + $item['quantity'],
                ], $existing->id);
            } else {
                // إنشاء سطر جديد
                $this->projectContainerRepo->create([
                    'project_id' => $projectId,
                    'items_id' => $item['item_id'],
                    'quantity_available' => $item['quantity'],
                    'expected_quantity' => 0,
                    'consumed_quantity' => 0,
                ]);
            }
        }
    }

}
