<?php
namespace App\Services;

use Exception;
use GuzzleHttp\Client As guzzleClient;
use App\Exceptions\userRequestException;
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
        return $this->httpRequest('POST', "https://reqres.in/api/users", [
            'json' => $userData
        ]);
    }

    public function getUserList($page, $perPage)
    {
        return $this->httpRequest('GET', "https://reqres.in/api/users", [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    public function getUserDetails($userId)
    {
        return $this->httpRequest('GET', "https://reqres.in/api/users/{$userId}", null);
    }

    public function updateUser($userId, $userName, $userJob)
    {
        return $this->httpRequest('PUT', "https://reqres.in/api/users/{$userId}", [
            'json' => [
                'name' => $userName,
                'job' => $userJob,
            ],
        ]);
    }

    public function deleteUser($userId)
    {
        return $this->httpRequest('DELETE', "https://reqres.in/api/users/{$userId}", null);
    }

    /**
     * @param string $requestType - POST, PUT, DELETE, GET
     * @param string $requestUrl
     * @param array|null $requestPayload
     */
    private function httpRequest($requestType, $requestUrl, $requestPayload)
    {
        try
        {
            $response = $this->guzzleClient->request($requestType, $requestUrl, $requestPayload);
            $body = $response->getBody()->getContents();
            return json_decode($body, true);
        } catch (Exception $e) {
            return throw new userRequestException($e->getMessage());
        }
    }
}
