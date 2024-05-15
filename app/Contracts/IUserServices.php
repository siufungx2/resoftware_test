<?php

namespace App\Contracts;

interface IUserServices
{
    /**
     * @param array $userData
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser($userData);

    /**
     * @param int $page
     * @param int $perPage
     * @return \Illuminate\Http\JsonResponse
    */
    public function getUserList($page, $perPage);

    /**
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserDetails($userId);
}
