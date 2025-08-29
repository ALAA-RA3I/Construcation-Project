<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\Contracts\UserPropertyUnitInstallmentsServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserInstallmentsResource;
use Illuminate\Http\Request;

class UserInstallmentsController extends Controller
{
    protected $userInstallmentsService;

    public function __construct(UserPropertyUnitInstallmentsServiceInterface $userInstallmentsService)
    {
        $this->userInstallmentsService = $userInstallmentsService;
    }
    public function getClientInstallments($propertyUnitId, $clientId)
    {
        $installments = $this->userInstallmentsService->getClientInstallments($propertyUnitId, $clientId);
        return ApiResponse::success(UserInstallmentsResource::collection($installments));
    }
}
