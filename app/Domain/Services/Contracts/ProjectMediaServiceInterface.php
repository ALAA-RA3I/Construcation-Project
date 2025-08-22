<?php

namespace App\Domain\Services\Contracts;

interface ProjectMediaServiceInterface
{
    public function getAll($projectId = null);
    public function paginate($projectId = null);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}
