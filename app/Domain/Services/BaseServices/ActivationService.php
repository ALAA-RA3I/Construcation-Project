<?php

namespace App\Domain\Services\BaseServices;

use App\Domain\Services\BaseServices\Contracts\ActivationServiceInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;

class ActivationService implements ActivationServiceInterface
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    public function activate(array $data)
    {
        $user = $this->userRepo->find($data['user_id']);
        return $this->userRepo->activateUser($user);
    }

    public function deactivate(array $data)
    {
        $user = $this->userRepo->find($data['user_id']);
        return $this->userRepo->deactivateUser($user);
    }
}
