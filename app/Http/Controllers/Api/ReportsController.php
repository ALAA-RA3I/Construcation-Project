<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\BaseServices\ReportsService;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $reportsService;

    public function __construct(ReportsService $reportsService)
    {
        $this->reportsService = $reportsService;
    }

    public function getCounts()
    {
        $counts = $this->reportsService->getCounts();
        return ApiResponse::success($counts,'Card Statistic',200);
    }
}
