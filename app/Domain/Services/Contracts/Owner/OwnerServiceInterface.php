<?php

namespace App\Domain\Services\Contracts\Owner;

interface OwnerServiceInterface
{
//    public function getAll(array $filters = [],  $search = null);
//    public function paginate(array $filters = [],  $search = null, $perPage = 10);
    public function getAll();
    public function paginate();
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}