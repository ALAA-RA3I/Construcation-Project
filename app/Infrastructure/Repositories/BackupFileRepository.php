<?php

namespace App\Infrastructure\Repositories;

use App\Infrastructure\Repositories\Contracts\BackupFileRepositoryInterface;
use App\Models\BackupFile;

class BackupFileRepository extends BaseRepository implements BackupFileRepositoryInterface
{
    public function model()
    {
        return BackupFile::class;
    }
}