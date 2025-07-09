<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ProjectSalesDetailsRepositoryInterface;
use App\Models\ProjectSalesDetails;

class ProjectSalesDetailsRepository extends BaseRepository implements ProjectSalesDetailsRepositoryInterface
{
    public function model()
    {
        return ProjectSalesDetails::class;
    }
}
