<?php

namespace App\Domain\Services\BaseServices\Contracts;

interface ActivationServiceInterface
{
    public function activate(array $data);
    public function deactivate(array $data);

}
