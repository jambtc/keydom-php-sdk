<?php

namespace Keydom\Auth;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class AuthService
{
    private Client $client;
    private string $baseUrl;
    private ?string $token = null;

    public function __construct(string $baseUrl)
    {
        $this->client = new Client(['verify' => false]);
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function authenticate(string $username, string $password): ?string
    {
        try {
            $response = $this->client->post($this->baseUrl . '/authentication/login', [
                'json' => [
                    'username' => $username,
                    'passwordHash' => strtoupper(md5($password))
                ]
            ]);
            $object = json_decode($response->getBody()->getContents(), false);

            return $this->token = $object->data->token ?? null;
        } catch (RequestException $e) {
            // echo $e->getMessage(); exit;
            return null;
        }
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
