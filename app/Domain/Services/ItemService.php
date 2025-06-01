<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ItemRepositoryInterface;
use App\Domain\Services\Contracts\ItemServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class ItemService implements ItemServiceInterface
{
    protected $itemRepo;

    public function __construct(ItemRepositoryInterface $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }

    public function getAll()
    {
        $this->itemRepo->pushCriteria(new WithRelationsCriteria(['projectContainer', 'taskContainer']));
        return $this->itemRepo->all();
    }

    public function paginate()
    {
        $this->itemRepo->pushCriteria(new WithRelationsCriteria(['projectContainer', 'taskContainer']));
        return $this->itemRepo->paginate();
    }

    public function create(array $data)
    {
        $item = $this->itemRepo->create($data);
        return $item->load(['projectContainer', 'taskContainer']);
    }

    public function show($id)
    {
        $item = $this->itemRepo->pushCriteria(new WithRelationsCriteria(['projectContainer', 'taskContainer']))->find($id);
        return $item;
    }

    public function update($id, array $data)
    {
        try {
            $item = $this->itemRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Item not found');
        }

        $this->itemRepo->update($data, $id);
        return $item->fresh()->load(['projectContainer', 'taskContainer']);
    }

    public function delete($id)
    {
        return $this->itemRepo->delete($id);
    }
}