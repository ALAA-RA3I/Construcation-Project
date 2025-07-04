<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface
{
    public function model()
    {
        return Client::class;
    }
}