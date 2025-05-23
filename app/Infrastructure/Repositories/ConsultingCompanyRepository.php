<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\ConsultingCompanyRepositoryInterface;
use App\Models\ConsultingCompany;

class ConsultingCompanyRepository extends BaseRepository implements ConsultingCompanyRepositoryInterface
{
    public function model()
    {
        return ConsultingCompany::class;
    }
}