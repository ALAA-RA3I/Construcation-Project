<?php

namespace App\Domain\Services\Contracts;

interface EngineerSpecializationServiceInterface
{
    public function getAll(array $filters = [],  $search = null);
    public function paginate(array $filters = [],  $search = null, $perPage = 10);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}