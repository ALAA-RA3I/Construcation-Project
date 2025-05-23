<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ConsultingEngineerRepositoryInterface;
use App\Models\ConsultingEngineer;

class ConsultingEngineerRepository extends BaseRepository implements ConsultingEngineerRepositoryInterface
{
    public function model()
    {
        return ConsultingEngineer::class;
    }
}