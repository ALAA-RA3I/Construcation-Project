<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\Repositories\Contracts\EngineerRepositoryInterface;
use App\Domain\Services\Contracts\EngineerServiceInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EngineerService implements EngineerServiceInterface
{
    protected $engineerRepo;
    protected $userRepo;

    public function __construct(EngineerRepositoryInterface $engineerRepo,UserRepositoryInterface $userRepo )
    {
        $this->engineerRepo = $engineerRepo;
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        $this->engineerRepo->pushCriteria(new WithRelationsCriteria(['user','specialization']));
        return $this->engineerRepo->all();
    }

    public function paginate() : LengthAwarePaginator
    {
        $this->engineerRepo->pushCriteria(new WithRelationsCriteria(['user','specialization']));
        return $this->engineerRepo->paginate();
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
            $user->assignRole('engineer');

            // Extract engineer fields
            $engineerData = Arr::only($data, [
                'engineer_specialization_id',
                'years_of_experience',
            ]);
            $engineerData['user_id'] = $user->id;

            return $this->engineerRepo->create($engineerData)->load(['user', 'specialization']);
        });
    }

    public function show($id)
    {
        try {
            $engineer = $this->engineerRepo
                ->pushCriteria(new WithRelationsCriteria(['user', 'specialization']))
                ->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Engineer not found');
        }

        return $engineer;
    }

    public function update($id, array $data): bool
    {
        return DB::transaction(function () use ($id, $data) {
            try {
                $engineer = $this->engineerRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('Engineer not found');
            }

            // Update user
            $userData = Arr::only($data, ['first_name', 'last_name', 'email', 'phone_number']);
            if (isset($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }
            $engineer->user->update($userData);

            // Update engineer
            $engineerData = Arr::only($data, ['engineer_specialization_id', 'years_of_experience']);
            $engineer->update($engineerData);

            return true;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                $engineer = $this->engineerRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('Engineer not found');
            }

            $engineer->user->delete(); // or soft delete
            $engineer->delete();

            return true;
        });
    }
}
