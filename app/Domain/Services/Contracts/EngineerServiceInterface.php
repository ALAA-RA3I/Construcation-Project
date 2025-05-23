<?php

namespace App\Domain\Services\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface EngineerServiceInterface
{
    public function getAll();
    public function paginate() : LengthAwarePaginator;
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}
