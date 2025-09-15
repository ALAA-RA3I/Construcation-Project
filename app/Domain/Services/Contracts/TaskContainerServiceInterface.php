<?php

namespace App\Domain\Services\Contracts;

interface TaskContainerServiceInterface
{
    public function getAll($taskId = null);
    public function paginate($taskId = null);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}
