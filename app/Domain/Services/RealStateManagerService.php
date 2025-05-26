<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\RealStateManagerRepositoryInterface;
use App\Domain\Services\Contracts\RealStateManagerServiceInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;



class RealStateManagerService implements RealStateManagerServiceInterface
{
    protected $realStateManagerRepo;
    protected $userRepo;

    public function __construct(RealStateManagerRepositoryInterface $realStateManagerRepo, UserRepositoryInterface $userRepo)
    {
        $this->realStateManagerRepo = $realStateManagerRepo;
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        $this->realStateManagerRepo->pushCriteria(new WithRelationsCriteria(['user']));
        return $this->realStateManagerRepo->all();
    }

    public function paginate()
    {
        $this->realStateManagerRepo->pushCriteria(new WithRelationsCriteria(['user']));
        return $this->realStateManagerRepo->paginate();
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $userData = $this->userRepo->create($data);
        $userData->assignRole('realStateManager');

        $realStateManager = [
            'user_id' => $userData->id
        ];

        return $this->realStateManagerRepo->create($realStateManager)->load('user');
    }

    public function show($id)
    {
        $realStateManager = $this->realStateManagerRepo->pushCriteria(new WithRelationsCriteria(['user']))->find($id);
        return $realStateManager;
    }

    public function update($id, array $data)
    {
        try {
            $manager = $this->realStateManagerRepo->find($id);
        }catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Manager not found');
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        
        $manager->user->update($data);

        return $manager->fresh()->load('user');
    }

    public function delete($id)
    {
        return $this->realStateManagerRepo->delete($id);
    }
}