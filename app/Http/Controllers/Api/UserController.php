<?php

namespace App\Http\Controllers\Api;

use App\Domain\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $service)
    {
        $this->userService = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->input('filters', []);
        $search = $request->input('search');

        $users = $this->userService->getAllUsers($filters, $search);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $user = $this->userService->create($request->all());
        return response()->json($user, 201);
    }

    public function show($id)
    {
        return response()->json($this->userService->show($id));
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
