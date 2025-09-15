<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ProjectBillsDTO\ProjectBillsDTO;
use App\Domain\Services\Contracts\ProjectBillServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectContainer\CreateProjectBillsRequest;
use App\Http\Resources\ProjectBillDetailsResource;
use App\Http\Resources\ProjectBillsResource;
use Illuminate\Http\Request;

class ProjectBillsController extends Controller
{
    private $projectBillService ;
    public function __construct(ProjectBillServiceInterface $projectBillService)
    {
        $this->projectBillService = $projectBillService;
    }
    public function getBillsOfProject($projectId) {
        $bills = $this->projectBillService->paginate($projectId);
        return ApiResponse::success(ProjectBillsResource::collection($bills));
    }
    public function getBillDetails($billId)
    {
        $bill = $this->projectBillService->show($billId);
        $details = $bill->billsDetails;
        return ApiResponse::success(ProjectBillDetailsResource::collection($details));
    }
    public function create(CreateProjectBillsRequest $request)
    {
        $data = ProjectBillsDTO::fromCreateRequest($request->validated());
        $bill = $this->projectBillService->createBillWithDetails($data);
        return ApiResponse::success(new ProjectBillsResource($bill));
    }

}
