<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\User\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->success(compact('users'), 'Users retrieved successfully');
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return response()->success(compact('user'), 'User retrieved successfully');
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return response()->success(compact('user'), 'User created successfully', 201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->userService->updateUser($id, $request->validated());
        return response()->success(compact('user'), 'User updated successfully');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return response()->success([], 'User deleted successfully');
    }
}
