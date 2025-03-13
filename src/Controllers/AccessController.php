<?php

namespace Keydom\Controllers;

use Keydom\Auth\AuthService;
use Keydom\Http\Client;

/**
 * AccessController class
 * 
 * This controller handles Access
 */
class AccessController
{
    private AuthService $authService;
    private Client $client;

    /**
     * Constructor method
     *
     * Initializes the AccessController with AuthService and creates a new HTTP client instance.
     *
     * @param AuthService $authService The authentication service to handle authorization.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->client = new Client();
    }


    /**
     * Get Access Information
     *
     * Fetches information about a specific access using its user ID.
     *
     * @param string $uuid The ID of the access to retrieve information for.
     * @return object|null Returns an object of access information if successful, or null if the request fails.
     */
    public function getByKey(string $uuid): ?object
    {
        // Makes an HTTP GET request to fetch user information.
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'GET',
            '/accessMedias/getByKey/?uuid=' . $uuid,
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
     * Create New Access
     * 
     * @return object|null Returns new access information if successful, or null if the request fails.
     */
    /*
    {
        "identifier": <string, required, has unique constraint>,
        "mediaTypeCode": <number, required>,
        "number": <number, optional, has unique constraint>,
        "enabled": <boolean, required>,
        "validityStart": <number, required>,
        "validityEnd": <number, required>,
        "validityMode": <number, required>,
        "antipassbackEnabled": <boolean, required>,
        "countingEnabled": <boolean, required>,
        "userUuid": <string, optional>,
        "profileUuidOrName": <string, optional>,
        "lifeCycleMode": <number, required>,
        "relatedAccessMediaNumber": <number, optional>
    }
    */
    public function create(array $jsonBody): ?object
    {
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'POST',
            '/accessMedias/insert',
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
     * update Access
     * 
     * @return object|null Returns Access information if successful, or null if the request fails.
     */
    /*
    {
        "uuid": <string, required, has unique constraint>,
        "identifier": <string, required, has unique constraint>,
        "mediaTypeCode": <number, required>,
        "number": <number, optional, has unique constraint>,
        "enabled": <boolean, required>,
        "validityStart": <number, required>,
        "validityEnd": <number, required>,
        "validityMode": <number, required>,
        "antipassbackEnabled": <boolean, required>,
        "countingEnabled": <boolean, required>,
        "userUuid": <string, optional>,
        "profileUuidOrName": <string, optional>,
        "lifeCycleMode": <number, required>,
        "relatedAccessMediaNumber": <number, optional>
    }
    */
    public function update(array $jsonBody): ?object
    {
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'PUT',
            '/accessMedias/update',
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
     * Delete Access
     * 
     * @return object|null Returns boolean, or null if the request fails.
     */
    public function delete(string $uuid): ?object
    {
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'DELETE',
            '/accessMedias/delete?uuid=' . $uuid,
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
