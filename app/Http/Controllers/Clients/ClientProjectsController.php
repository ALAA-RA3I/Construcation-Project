<?php

namespace App\Http\Controllers\Clients;

use App\Domain\Services\Contracts\PropertyUnitServiceInterface;
use App\Domain\Services\Contracts\UserPropertyUnitInstallmentsServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BillsResources;
use App\Http\Resources\Client\ClientProjectDetailsResource;
use App\Http\Resources\Client\ClientProjectNewsResource;
use App\Http\Resources\Client\ClientProjectsResource;
use Illuminate\Support\Facades\Auth;

class ClientProjectsController extends Controller
{
    private $propertyUnitService ;
    private $propertyInstallmentsService;
    public function __construct(
        PropertyUnitServiceInterface $propertyUnitService,
        UserPropertyUnitInstallmentsServiceInterface $propertyInstallmentsService) {
        $this->propertyUnitService = $propertyUnitService ;
        $this->propertyInstallmentsService = $propertyInstallmentsService;
    }

    public function getProjects()
    {
        $clientId = Auth::guard('api-client')->user()->id;
        $projects = $this->propertyUnitService->getProjectsOfClient($clientId);
        return ApiResponse::success(ClientProjectsResource::collection($projects),'Client Projects Return Successfully');
    }
    public function getProjectDetails($propertyUnitId)
    {
        $project = $this->propertyUnitService->getProjectDetailsByPropertyUnit($propertyUnitId);

        if (!$project) {
            return ApiResponse::error('Project not found', 404);
        }

        return ApiResponse::success(new ClientProjectDetailsResource($project), 'Client Project Details Returned Successfully');
    }
    public function getClientProjectsNews()
    {
        $clientId = Auth::guard('api-client')->user()->id;
        $news = $this->propertyUnitService->getClientProjectNews($clientId);

        if ($news->isEmpty()) {
            return ApiResponse::success([], 'No project news found for this client.');
        }
        return ApiResponse::success(ClientProjectNewsResource::collection($news), 'Client Project News Retrieved Successfully');
    }
//    public function getClientProjectBills() {
//        $bills = $this->propertyInstallmentsService->getAll();
//        return ApiResponse::success(BillsResources::collection($bills),'All bills returned successfully');
//    }
    public function getPaidBills($propertyUnitId)
    {
        $bills = $this->propertyInstallmentsService->getBillsByStatus($propertyUnitId, true);
        return ApiResponse::success(BillsResources::collection($bills), 'Paid bills returned successfully');
    }

    public function getUnpaidBills($propertyUnitId)
    {
        $bills = $this->propertyInstallmentsService->getBillsByStatus($propertyUnitId, false);
        return ApiResponse::success(BillsResources::collection($bills), 'Unpaid bills returned successfully');
    }
}
