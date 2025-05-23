<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\Repositories\Contracts\ConsultingEngineerRepositoryInterface;
use App\Domain\Services\Contracts\ConsultingEngineerServiceInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ConsultingEngineerService implements ConsultingEngineerServiceInterface
{
    protected $consultingEngineerRepo;
    protected $userRepo;

    public function __construct(ConsultingEngineerRepositoryInterface $consultingEngineerRepo,UserRepositoryInterface $userRepo)
    {
        $this->consultingEngineerRepo = $consultingEngineerRepo;
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        $this->consultingEngineerRepo->pushCriteria(new WithRelationsCriteria(['user','specialization','consultingCompany']));
        return $this->consultingEngineerRepo->all();
    }

    public function paginate()
    {
        $this->consultingEngineerRepo->pushCriteria(new WithRelationsCriteria(['user','specialization','consultingCompany']));
        return $this->consultingEngineerRepo->paginate();
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
            $user->assignRole('consultingEngineer');

            // Extract engineer fields
            $engineerData = Arr::only($data, [
                'engineer_specialization_id',
                'consulting_company_id',
            ]);
            $engineerData['user_id'] = $user->id;

            return $this->consultingEngineerRepo->create($engineerData)->load(['user', 'specialization','consultingCompany']);
        });
    }

    public function show($id)
    {
        try {
            $engineer = $this->consultingEngineerRepo
                ->pushCriteria(new WithRelationsCriteria(['user', 'specialization','consultingCompany']))
                ->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Engineer not found');
        }

        return $engineer;    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            try {
                $engineer = $this->consultingEngineerRepo->find($id);
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
            $engineerData = Arr::only($data, ['engineer_specialization_id', 'consulting_company_id']);
            $engineer->update($engineerData);
            return true;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                $engineer = $this->consultingEngineerRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('Engineer not found');
            }

            $engineer->user->delete(); // or soft delete
            $engineer->delete();

            return true;
        });    }
}
