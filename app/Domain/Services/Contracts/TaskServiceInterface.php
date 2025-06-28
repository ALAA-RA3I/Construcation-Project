<?php

namespace App\Domain\Services\Contracts;

interface TaskServiceInterface
{
    public function getAll($stageId);
    public function paginate($stageId);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
    public function markTaskAsDone($id);
    public function markTaskAsRefuse(array $data ,$id);
}