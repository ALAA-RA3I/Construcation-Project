<?php

namespace App\Domain\Services\Contracts;

interface PropertyBookServiceInterface
{
    public function getAll($projectId);
    public function paginate($projectId);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
    public function getPropertyUnits($bookId);
}
