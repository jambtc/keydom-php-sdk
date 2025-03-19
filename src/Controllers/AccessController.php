<?php

namespace Keydom\Controllers;

use Keydom\Auth\AuthService;

/**
 * AccessController class
 * 
 * This controller handles Access
 */
class AccessController
{
    private AuthService $authService;

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

        $response = $this->authService->getClient()->get(
            $this->authService->getBaseUrl() . '/accessMedias/getByKey/update',  // URI relativo
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
    public function create(array $body): ?object
    {
        $response = $this->authService->getClient()->post(
            $this->authService->getBaseUrl() . '/accessMedias/insert',  
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
    public function update(array $body): ?object
    {
        $response = $this->authService->getClient()->put(
            $this->authService->getBaseUrl() . '/accessMedias/update',  // URI relativo
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
     * Delete Access
     * 
     * @return object|null Returns boolean, or null if the request fails.
     */
    public function delete(string $uuid): ?object
    {
        $response = $this->authService->getClient()->delete(
            $this->authService->getBaseUrl() . '/accessMedias/delete/?uuid=' . $uuid,
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
