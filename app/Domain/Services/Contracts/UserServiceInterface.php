<?php

namespace App\Domain\Services\Contracts;

interface UserServiceInterface
{
    public function getAll();

    public function paginate();

    public function create(array $data);

    public function show($id);

    public function update($id, array $data);

    public function delete($id);
}
