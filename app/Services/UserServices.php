<?php
namespace App\Services;

use Exception;
use GuzzleHttp\Client As guzzleClient;
use App\Exceptions\getUsersException As getUsersException;
use App\Contracts\IUserServices;

class UserServices implements IUserServices
{
    protected $guzzleClient;

    public function __construct(guzzleClient $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    public function createUser($userData)
    {
        try
        {
            $response = $this->guzzleClient->request('POST', "https://reqres.in/api/users", [
                'json' => $userData
            ]);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (Exception $e) {
            return throw new getUsersException($e->getMessage());
        }
    }

    public function getUserList($page, $perPage)
    {
        try
        {
            $response = $this->guzzleClient->request('GET', "https://reqres.in/api/users?page={$page}&per_page={$perPage}");
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (Exception $e) {
            return throw new getUsersException($e->getMessage());
        }
    }

    public function getUserDetails($userId)
    {
        try
        {
            $response = $this->guzzleClient->request('GET', "https://reqres.in/api/users/{$userId}");
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (Exception $e) {
            return throw new getUsersException($e->getMessage());
        }
    }

    public function updateUser($userId, $userName, $userJob)
    {
        try
        {
            $response = $this->guzzleClient->request('PUT', "https://reqres.in/api/users/{$userId}", [
                'json' => [
                    'name' => $userName,
                    'job' => $userJob,
                ],
            ]);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (Exception $e) {
            return throw new getUsersException($e->getMessage());
        }
    }

    public function deleteUser($userId)
    {
        try
        {
            $response = $this->guzzleClient->request('DELETE', "https://reqres.in/api/users/{$userId}");
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (Exception $e) {
            return throw new getUsersException($e->getMessage());
        }
    }
}
