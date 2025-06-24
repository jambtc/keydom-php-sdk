<?php

namespace Keydom\Controllers;

use Keydom\Auth\AuthService;

/**
 * VisitsController class
 * 
 * This controller handles Access
 */
class VisitsController
{
    private AuthService $authService;

    /**
     * Constructor method
     *
     * Initializes the VisitsController with AuthService and creates a new HTTP client instance.
     *
     * @param AuthService $authService The authentication service to handle authorization.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Get Visit Information
     *
     * Fetches information about a specific visit using its user ID.
     *
     * @param string $uuid The ID of the visit to retrieve information for.
     * @return object|null Returns an object of visit information if successful, or null if the request fails.
     */
    public function getByKey(string $uuid): ?object
    {

        $response = $this->authService->getClient()->get(
            $this->authService->getBaseUrl() . '/visits?getByKey' . $uuid,  // URI relativo
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
     * Create New Visit
     * 
     * @return object|null Returns new visit information if successful, or null if the request fails.
     */
    /*
    {
        "uuid": <string, optional, has unique constraint>,
        "userUuid": <string, optional>,
        "initialTimestamp": <number, required>,
        "finalTimestamp": <number, required>,
        "field1": <string, optional>,
        "field2": <string, optional>,
        "field3": <string, optional>,
        "notes": <string, optional>,
        "preVisitAccessMediaType": <number, optional>,
        "preVisitAccessMediaIdentifier": <string, optional>,
        "preVisitAccessProfileUuid": <string, optional>,
        "visitFirstAccessMediaType": <number, optional>,
        "visitFirstAccessMediaIdentifier": <string, optional>,
        "visitFirstAccessMediaNumber": <number, optional>,
        "visitFirstProfileUuid": <string, optional>,
        "visitSecondAccessMediaType": <number, optional>,
        "visitSecondAccessMediaIdentifier": <string, optional>,
        "visitSecondAccessMediaNumber": <number, optional>,
        "visitSecondProfileUuid": <string, optional>,
        "visitThirdAccessMediaType": <number, optional>,
        "visitThirdAccessMediaIdentifier": <string, optional>,
        "visitThirdAccessMediaNumber": <number, optional>,
        "visitThirdProfileUuid": <string, optional>,
        "relatedUserUuid": <string, optional>
        "openVisitNow": <boolean, optional>,
        "siteId": <number, required>,
    }
    */
    public function create(array $body): ?object
    {
        $response = $this->authService->getClient()->post(
            $this->authService->getBaseUrl() . '/visits/insert',  
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
     * update Visit
     * 
     * @return object|null Returns Visit information if successful, or null if the request fails.
     */
    
    public function update(array $body): ?object
    {
        $response = $this->authService->getClient()->put(
            $this->authService->getBaseUrl() . '/visits/update',  // URI relativo
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
     * Delete Visit
     * 
     * @return object|null Returns boolean, or null if the request fails.
     */
    public function delete(string $uuid): ?object
    {
        $response = $this->authService->getClient()->delete(
            $this->authService->getBaseUrl() . '/visits/delete/?uuid=' . $uuid,
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
