<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\EngineerSpecializationRepositoryInterface;
use App\Models\EngineerSpecialization;

class EngineerSpecializationRepository extends BaseRepository implements EngineerSpecializationRepositoryInterface
{
    public function model()
    {
        return EngineerSpecialization::class;
    }
}