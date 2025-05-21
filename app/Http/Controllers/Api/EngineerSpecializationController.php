<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\Contracts\EngineerSpecializationServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\EngineerSpecializationResource;
use Illuminate\Http\Request;

class EngineerSpecializationController extends Controller
{
    private  $engineerSpecializationService ;

    public function __construct(EngineerSpecializationServiceInterface $service)
    {
        $this->engineerSpecializationService = $service;
    }
    public function index()
    {
        $users = $this->engineerSpecializationService->paginate();
        return ApiResponse::success(EngineerSpecializationResource::collection($users));
    }
}
