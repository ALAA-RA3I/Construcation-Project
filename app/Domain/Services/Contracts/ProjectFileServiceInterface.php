<?php

namespace App\Domain\Services\Contracts;

interface ProjectFileServiceInterface
{
//    public function getAll(array $filters = [],  $search = null);
//    public function paginate(array $filters = [],  $search = null, $perPage = 10);
    public function getAll();
    public function paginate($id);
    public function create(array $data, $id);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
    public function getAllProjectFiles($id);
}