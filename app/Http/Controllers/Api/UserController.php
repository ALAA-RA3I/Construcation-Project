<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\UserService;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected  $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index(Request $request)
    {
        $data =  getRequestFilters($request);
        $users = $this->userService->getAllUsers($data['filters'], $data['search'],$data['perPage']);
        return ApiResponse::success($users);
    }

    public function store(Request $request)
    {
        $user = $this->userService->create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = $this->userService->show($id);
         return ApiResponse::error('user not found');

    }

    public function update(Request $request, $id)
    {
        $user = $this->userService->update($id, $request->all());
        return response()->json($user);
    }

    public function destroy($id)
    {
        $this->userService->delete($id);
        return response()->json(['message' => 'Deleted']);
    }
}
