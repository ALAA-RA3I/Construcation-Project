<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
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
                    'price'
                ]);
                $item = $this->itemRepo->create($itemData);
                $projectContainerData = Arr::only($data, [
                    'quantity-available',
                    'expected-quantity',
                    'consumed-quantity',
                    'required-quantity',
                    'remaining-quantity',
                ]);
                $projectContainerData['project_id'] = $project->id;
                $projectContainerData['items_id'] = $item->id;
                $itemCreated = $this->projectContainerRepo->create($projectContainerData);
            }catch(ModelNotFoundException $e) {
                return $e->getMessage();
            }

            return $itemCreated;
        });
    }

    public function createIfExisit(array $data,$projectID,$itemID) {
        try {
            $project = $this->projectRepo->findOrFail($projectID);
            $item = $this->itemRepo->findOrFail($itemID);

            $data['project_id'] = $project->id;
            $data['items_id'] = $item->id;

            return $this->projectContainerRepo->create($data);
        } catch (ModelNotFoundException $e) {
            Log::error("Project or Item not found", [
                'projectID' => $projectID,
                'itemID' => $itemID,
            ]);
            throw $e; // أو رجع response مناسب
        }
    }

    public function show($id)
    {
        return $this->projectContainerRepo->find($id);
    }

    public function update($id, array $data)
    {
        return $this->projectContainerRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->projectContainerRepo->delete($id);
    }
}