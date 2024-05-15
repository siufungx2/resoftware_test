<?php

namespace App\Http\Controllers;

use App\Contracts\IUserServices;
use App\Http\Requests\getUserListRequest As GetUserListRequest;
use App\Http\Requests\createUserRequest As CreateUserRequest;
use App\Http\Requests\updateUserRequest As UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(IUserServices $userService)
    {
        $this->userService = $userService;
    }

    public function createUser(CreateUserRequest $request)
    {
        $userData = [
            'name' => $request->name,
            'job' => $request->job,
        ];
        return $this->userService->createUser($userData);
    }

    /**
     * @param App\Http\Requests\getUserListRequest
     */
    public function getUserList(GetUserListRequest $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 6);

        return $this->userService->getUserList($page, $perPage);
    }

    /**
     * @param App\Http\Requests\getUserListRequest
     * @param int $userId
     */
    public function getUserDetails($userId)
    {
        return $this->userService->getUserDetails($userId);
    }

    public function updateUser(UpdateUserRequest $request, $userId)
    {
        $userName = $request->name;
        $userJob = $request->job;
        return $this->userService->updateUser($userId, $userName, $userJob);
    }

    public function deleteUser($userId)
    {
        return $this->userService->deleteUser($userId);
    }
}
