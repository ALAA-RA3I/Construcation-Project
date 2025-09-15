<?php

namespace App\Domain\Services;

use App\Criteria\AdvancedDynamicFilterSearchCriteria;
use App\Criteria\WhereCriteria;
use App\Criteria\WithRelationsCriteria;
use App\Infrastructure\Repositories\Contracts\ProjectBillDetailRepositoryInterface;
use App\Infrastructure\Repositories\Contracts\ProjectBillRepositoryInterface;
use App\Domain\Services\Contracts\ProjectBillServiceInterface;

class ProjectBillService implements ProjectBillServiceInterface
{
    protected $projectBillRepo;
    protected $projectBillDetails;

    public function __construct(ProjectBillRepositoryInterface $projectBillRepo,ProjectBillDetailRepositoryInterface $projectBillDetails)
    {
        $this->projectBillRepo = $projectBillRepo;
        $this->projectBillDetails = $projectBillDetails;
    }

    public function getAll()
    {
        return $this->projectBillRepo->all();
    }

    public function paginate($projectId = null)
    {
        if ($projectId) {
            $this->projectBillRepo->pushCriteria(new WhereCriteria('project_id', $projectId));
        }
        return $this->projectBillRepo->paginate();
    }

    public function create(array $data)
    {
        return $this->projectBillRepo->create($data);
    }

    public function show($id)
    {
        return $this->projectBillRepo->pushCriteria(new WithRelationsCriteria('billsDetails'))->find($id);
    }

    public function update($id, array $data)
    {
        return $this->projectBillRepo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->projectBillRepo->delete($id);
    }
    public function createBillWithDetails(array $data)
    {
        // Calculate total cost
        $totalCost = collect($data['details'])->sum('cost');

        // Create the main bill
        $bill = $this->projectBillRepo->create([
            'description' => $data['description'],
            'date_of_payment' => $data['date_of_payment'],
            'project_id' => $data['project_id'],
            'total_cost' => $totalCost,
        ]);

        // Insert bill details
        foreach ($data['details'] as $detail) {
            $this->projectBillDetails->create([
                'item' => $detail['item'],
                'note' => $detail['note'] ?? null,
                'cost' => $detail['cost'],
                'project_bill_id' => $bill->id,
            ]);
        }

        return $bill->load('billsDetails');
    }
}
