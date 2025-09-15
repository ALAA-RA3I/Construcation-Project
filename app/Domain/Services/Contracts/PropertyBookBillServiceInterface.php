<?php

namespace App\Domain\Services\Contracts;

interface PropertyBookBillServiceInterface
{
    public function getAll($propertyBookId);
    public function paginate($propertyBookId);
    public function create(array $data);
    public function show($id);
    public function update($id, array $data);
    public function delete($id);
}
