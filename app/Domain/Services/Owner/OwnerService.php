<?php

namespace App\Domain\Services\Owner;

use App\Criteria\WithRelationsCriteria;
use App\Domain\Services\Contracts\Owner\OwnerServiceInterface;
use App\Exceptions\EntityNotFoundException;
use App\Infrastructure\Repositories\Contracts\OwnerRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\UserRepositoryInterface;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class OwnerService implements OwnerServiceInterface
{
    protected $ownerServiceRepo;
    protected $userRepo;

    public function __construct(OwnerRepositoryInterface $ownerServiceRepo, UserRepositoryInterface $userRepo)
    {
        $this->ownerServiceRepo = $ownerServiceRepo;
        $this->userRepo = $userRepo;
    }

    public function getAll()
    {
        $this->ownerServiceRepo->pushCriteria(new WithRelationsCriteria(['user']));
        return $this->ownerServiceRepo->all();
    }

    public function paginate()
    {

        $this->ownerServiceRepo->pushCriteria(new WithRelationsCriteria(['user']));
        return $this->ownerServiceRepo->paginate();
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $userData = Arr::only($data, [
                'first_name',
                'last_name',
                'email',
                'phone_number',
            ]);
            $userData['password'] = Hash::make($data['password']);
            $addditionalData = Arr::only($data, [
                'address',
                'national_id',
            ]);
            $user = $this->userRepo->createUserWithExtraData($userData, $addditionalData, new Owner());
            $user->assignRole('owner');
            return $user->load('owner');
        });
    }

    public function show($id)
    {
        try {
            $owner = $this->ownerServiceRepo
                ->pushCriteria(new WithRelationsCriteria(['user']))
                ->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Owner not found');
        }

        return $owner;
        return $this->ownerServiceRepo->find($id);
    }

    public function update($id, array $data)
    {

        return DB::transaction(function () use ($id, $data) {
            try {
                $owner = $this->ownerServiceRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('owner not found');
            }

             $userData = Arr::only($data, ['first_name', 'last_name', 'email', 'phone_number']);
            if (isset($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }
            $owner->user->update($userData);

             $ownerData = Arr::only($data, [

                'address',
                'national_id',
            ]);
            $owner->update($ownerData);
            return true;
        });

      
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            try {
                $owner = $this->ownerServiceRepo->find($id);
            } catch (ModelNotFoundException $e) {
                throw new EntityNotFoundException('owner not found');
            }

            $owner->user->delete();
            $owner->delete();

            return true;
        });
        return $this->ownerServiceRepo->delete($id);
    }
}
