<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectBillDetailRepositoryInterface;
use App\Models\ProjectBillDetail;

class ProjectBillDetailRepository extends BaseRepository implements ProjectBillDetailRepositoryInterface
{
    public function model()
    {
        return ProjectBillDetail::class;
    }
}