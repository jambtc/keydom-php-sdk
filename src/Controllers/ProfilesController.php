<?php

namespace Keydom\Controllers;

use Keydom\Auth\AuthService;

/**
 * ProfileController class
 * 
 * This controller handles Users
 */
class ProfileController
{
    private AuthService $authService;

    /**
     * Constructor method
     *
     * Initializes the ProfileController with AuthService and creates a new HTTP client instance.
     *
     * @param AuthService $authService The authentication service to handle authorization.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function getProfiles(): ?object
    {
        $response = $this->authService->getClient()->get(
            $this->authService->getBaseUrl() . '/profiles/getAll',
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
