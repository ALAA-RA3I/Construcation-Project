<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\Repositories\Contracts\ProjectManagerRepositoryInterface;
use App\Domain\Services\Contracts\ProjectManagerServiceInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProjectManagerService implements ProjectManagerServiceInterface
{
    protected $projectManagerRepo;
    protected $userRepo;

    public function __construct(ProjectManagerRepositoryInterface $projectManagerRepo,UserRepositoryInterface $userRepo)
    {
        $this->projectManagerRepo = $projectManagerRepo;
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        $this->projectManagerRepo->pushCriteria(new WithRelationsCriteria(['user']));
        return $this->projectManagerRepo->all();
    }

    public function paginate()
    {
        $this->projectManagerRepo->pushCriteria(new WithRelationsCriteria(['user']));
        return $this->projectManagerRepo->paginate();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Extract user fields
            $userData = Arr::only($data, [
                'first_name',
                'last_name',
                'email',
                'phone_number',
            ]);
            $userData['password'] = Hash::make($data['password']);
            $user = $this->userRepo->create($userData);
            $user->assignRole('projectManager');

            // Extract engineer fields
            $projectManagerData = Arr::only($data, [
                'bio',
                'years_of_experience',
            ]);
            $projectManagerData['user_id'] = $user->id;

            return $this->projectManagerRepo->create($projectManagerData)->load(['user']);
        });
    }

    public function show($id)
    {
        try {
            $manager = $this->projectManagerRepo
                ->pushCriteria(new WithRelationsCriteria(['user']))
                ->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Manager not found');
        }
        return $manager;
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            try {
                $manager = $this->projectManagerRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('Manager not found');
            }

            // Update user
            $userData = Arr::only($data, ['first_name', 'last_name', 'email', 'phone_number']);
            if (isset($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }
            $manager->user->update($userData);

            // Update engineer
            $managerData = Arr::only($data, ['bio', 'years_of_experience']);
            $manager->update($managerData);

            return true;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                $manager = $this->projectManagerRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('Manager not found');
            }
            $manager->user->delete(); // or soft delete
            $manager->delete();
            return true;
        });
    }
}
