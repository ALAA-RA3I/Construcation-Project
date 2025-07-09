<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectBillRepositoryInterface;
use App\Models\ProjectBill;

class ProjectBillRepository extends BaseRepository implements ProjectBillRepositoryInterface
{
    public function model()
    {
        return ProjectBill::class;
    }
}