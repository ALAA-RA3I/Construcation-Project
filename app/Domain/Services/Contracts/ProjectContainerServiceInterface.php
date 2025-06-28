<?php

namespace App\Domain\Services\Contracts;

interface ProjectContainerServiceInterface
{
//    public function getAll(array $filters = [],  $search = null);
//    public function paginate(array $filters = [],  $search = null, $perPage = 10);
    public function getAll($id);
    public function paginate();
    public function createIfNotExisit(array $data,$id);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
    public function createIfExisit(array $data,$id1,$id2);
}