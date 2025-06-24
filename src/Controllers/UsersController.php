<?php

namespace Keydom\Controllers;

use Keydom\Auth\AuthService;

/**
 * UsersController class
 * 
 * This controller handles Users
 */
class UsersController
{
    private AuthService $authService;

    /**
     * Constructor method
     *
     * Initializes the UsersController with AuthService and creates a new HTTP client instance.
     *
     * @param AuthService $authService The authentication service to handle authorization.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
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
        $response = $this->authService->getClient()->get(
            $this->authService->getBaseUrl() . '/users/visitor/getByKey/?uuid=' . $uuid,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
            ]
        );

        $object = json_decode($response->getBody()->getContents(), false);

        // Returns the JSON response as an object, or null if the request failed.
        return $object ? $object : null;
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
    public function create(array $body): ?object
    {
        $response = $this->authService->getClient()->post(
            $this->authService->getBaseUrl() . '/users/visitor/insert',  // URI relativo
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
                'json' => $body
            ]
        );

        $object = json_decode($response->getBody()->getContents(), false);

        // Returns the JSON response as an object, or null if the request failed.
        return $object ? $object : null;
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
    public function update(array $body): ?object
    {
        $response = $this->authService->getClient()->put(
            $this->authService->getBaseUrl() . '/users/visitor/update',  // URI relativo
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
                'json' => $body
            ]
        );

        $object = json_decode($response->getBody()->getContents(), false);

        // Returns the JSON response as an object, or null if the request failed.
        return $object ? $object : null;
    }



    /**
     * Delete User
     * 
     * @return object|null Returns boolean, or null if the request fails.
     */
    public function delete(string $uuid): ?object
    {
        $response = $this->authService->getClient()->delete(
            $this->authService->getBaseUrl() . '/users/delete/?uuid=' . $uuid,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'fio-access-token' => $this->authService->getToken()
                ],
            ]
        );

        $object = json_decode($response->getBody()->getContents(), false);

        // Returns the JSON response as an object, or null if the request failed.
        return $object ? $object : null;
    }
}
