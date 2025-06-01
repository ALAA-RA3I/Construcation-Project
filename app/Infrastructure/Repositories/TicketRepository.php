<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\TicketRepositoryInterface;
use App\Models\Ticket;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    public function model()
    {
        return Ticket::class;
    }
}