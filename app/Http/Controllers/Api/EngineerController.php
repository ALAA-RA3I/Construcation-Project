<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\Contracts\EngineerServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EngineerResource;
use Illuminate\Http\Request;

class EngineerController extends Controller
{
    private  $engineerService ;

    public function __construct(EngineerServiceInterface $service)
    {
        $this->engineerService = $service;
    }
    public function index(Request $request)
    {
        $data =  getRequestFilters($request);
        $engineers = $this->engineerService->paginate($data['filters'], $data['search'],$data['perPage']);
        return ApiResponse::success(EngineerResource::collection($engineers));
    }
}
