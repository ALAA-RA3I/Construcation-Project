<?php

namespace App\Domain\Services;

use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectSalesDetailsRepositoryInterface;
use App\Domain\Services\Contracts\ProjectSalesDetailsServiceInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\EntityNotFoundException;
use Illuminate\Support\Facades\DB;

class ProjectSalesDetailsService implements ProjectSalesDetailsServiceInterface
{
    protected $projectSalesDetailsRepo;

    public function __construct(ProjectSalesDetailsRepositoryInterface $projectSalesDetailsRepo)
    {
        $this->projectSalesDetailsRepo = $projectSalesDetailsRepo;
    }

    public function getAll()
    {
        $this->projectSalesDetailsRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->projectSalesDetailsRepo->all();
    }

    public function paginate()
    {
        $this->projectSalesDetailsRepo->pushCriteria(new WithRelationsCriteria(['project']));
        return $this->projectSalesDetailsRepo->paginate();
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $projectSalesDetails = $this->projectSalesDetailsRepo->create($data);
            DB::commit();
            return $projectSalesDetails->load(['project']);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id)
    {
        $projectSalesDetails = $this->projectSalesDetailsRepo->pushCriteria(new WithRelationsCriteria(['project']))->find($id);
        return $projectSalesDetails;
    }

    public function update($id, array $data)
    {
        try {
            $projectSalesDetails = $this->projectSalesDetailsRepo->find($id);
        } catch (ModelNotFoundException $e) {
            throw new EntityNotFoundException('Project Sales Details not found');
        }

        $this->projectSalesDetailsRepo->update($data, $id);
        return $projectSalesDetails->fresh()->load(['project']);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $projectSalesDetails = $this->projectSalesDetailsRepo->find($id);

            if (!$projectSalesDetails) {
                return false;
            }

            // Soft delete the project sales details
            $projectSalesDetails->delete();

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
