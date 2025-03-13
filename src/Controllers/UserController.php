<?php

namespace Keydom\Controllers;

use Keydom\Auth\AuthService;
use Keydom\Http\Client;

/**
 * UserController class
 * 
 * This controller handles Users
 */
class UserController
{
    private AuthService $authService;
    private Client $client;

    /**
     * Constructor method
     *
     * Initializes the UserController with AuthService and creates a new HTTP client instance.
     *
     * @param AuthService $authService The authentication service to handle authorization.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->client = new Client();
    }


    /**
     * Get User Information
     *
     * Fetches information about a specific user using its user ID.
     *
     * @param string $uuid The ID of the user to retrieve information for.
     * @return object|null Returns an object of user information if successful, or null if the request fails.
     */
    public function getByKey(string $uuid): ?object
    {
        // Makes an HTTP GET request to fetch user information.
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'GET',
            '/users/visitor/getByKey/?uuid=' . $uuid,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
            ]
        );

        // Returns the JSON response as an object, or null if the request failed.
        return $response ? $response->getJson() : null;
    }




    /**
     * Create New User
     * 
     * @return object|null Returns new user information if successful, or null if the request fails.
     */
    /*
    {
        "lastName": <string, required>,
        "firstName": <string, required>,
        "registrationNumber": <string, optional>,
        "address": <string, optional>,
        "phone": <string, optional>,
        "email": <string, optional>,
        "documentNumber": <string, optional>
    }
    */
    public function create(array $jsonBody): ?object
    {
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'POST',
            '/users/visitor/insert',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
                'json' => $jsonBody
            ]
        );

        // Returns the JSON response as an object, or null if the request failed.
        return $response ? $response->getJson() : null;
    }

    /**
     * update User
     * 
     * @return object|null Returns user information if successful, or null if the request fails.
     */
    /*
    {
        "uuid": <string, required, has unique constraint>,
        "lastName": <string, required>,
        "firstName": <string, required>,
        "uniqueCode": <string, optional, has unique constraint>,
        "parentUuid": <string, optional>,
        "qualification": <string, optional>,
        "registrationNumber": <string, optional>,
        "address": <string, optional>,
        "phone": <string, optional>,
        "mobile": <string, optional>,
        "email": <string, optional>,
        "documentNumber": <string, optional>
    }
    */
    public function update(array $jsonBody): ?object
    {
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'PUT',
            '/users/visitor/update',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
                'json' => $jsonBody
            ]
        );

        // Returns the JSON response as an object, or null if the request failed.
        return $response ? $response->getJson() : null;
    }



    /**
     * Delete User
     * 
     * @return object|null Returns boolean, or null if the request fails.
     */
    public function delete(string $uuid): ?object
    {
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'DELETE',
            '/users/delete?uuid=' . $uuid,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
            ]
        );

        // Returns the JSON response as an object, or null if the request failed.
        return $response ? $response->getJson() : null;
    }
}
