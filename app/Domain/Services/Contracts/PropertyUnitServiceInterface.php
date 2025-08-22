<?php

namespace App\Domain\Services\Contracts;

interface PropertyUnitServiceInterface
{
    public function getAll($propertyBookId);
    public function paginate($propertyBookId);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
    public function getProjectsOfClient($clientId);
    public function getProjectDetailsByPropertyUnit($propertyUnitId);
    public function getClientProjectNews($clientId);


}
