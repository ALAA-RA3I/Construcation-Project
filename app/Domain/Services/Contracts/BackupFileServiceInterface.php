<?php

namespace App\Domain\Services\Contracts;

use App\Application\DTO\BackupfileDTO\BackupfileDTO;
use Illuminate\Http\UploadedFile;

interface BackupFileServiceInterface
{
//    public function getAll(array $filters = [],  $search = null);
//    public function paginate(array $filters = [],  $search = null, $perPage = 10);
    public function getAll($id);
    public function paginate();
    public function create(BackupfileDTO $file,$id);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}