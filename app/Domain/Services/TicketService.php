<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\TicketRepositoryInterface;
use App\Domain\Services\Contracts\TicketServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;

class TicketService implements TicketServiceInterface
{
    protected $ticketRepo;

    public function __construct(TicketRepositoryInterface $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }

    public function getAll()
    {
        $this->ticketRepo->pushCriteria(new WithRelationsCriteria(['task']));
        return $this->ticketRepo->all();
    }

    public function paginate()
    {
        $this->ticketRepo->pushCriteria(new WithRelationsCriteria(['task']));
        return $this->ticketRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->ticketRepo->create($data);
    }

    public function show($id)
    {
        try {
            $this->ticketRepo->pushCriteria(new WithRelationsCriteria(['task']));
            return $this->ticketRepo->find($id);
        } catch (ModelNotFoundException $exception) {
            throw new EntityNotFoundException();
        }
    }

    public function update($id, array $data)
    {
        try {
            return $this->ticketRepo->update($data, $id);
        } catch (ModelNotFoundException $exception) {
            throw new EntityNotFoundException();
        }
    }

    public function delete($id)
    {
        try {
            return $this->ticketRepo->delete($id);
        } catch (ModelNotFoundException $exception) {
            throw new EntityNotFoundException();
        }
    }
}