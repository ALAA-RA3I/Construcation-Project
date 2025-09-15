<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\UserPropertyUnitInstallmentsRepositoryInterface;
use App\Models\UserPropertyUnitInstallments;

class UserPropertyUnitInstallmentsRepository extends BaseRepository implements UserPropertyUnitInstallmentsRepositoryInterface
{
    public function model()
    {
        return UserPropertyUnitInstallments::class;
    }
}