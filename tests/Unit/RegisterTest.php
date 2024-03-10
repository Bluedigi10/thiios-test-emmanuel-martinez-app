<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class RegistrationTest extends TestCase
{
    private $baseUri;
    private $httpClient;

    protected function setUp(): void
    {
        parent::setUp();

        // Set the base URI for your application
        $this->baseUri = 'http://your-app-url';

        // Create a Guzzle HTTP client
        $this->httpClient = new Client([
            'base_uri' => $this->baseUri,
            'http_errors' => false, // To prevent exceptions on non-2xx responses
        ]);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        // Send a GET request to the registration endpoint
        $response = $this->httpClient->get('/register');

        // Check if the response status is 200
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_new_users_can_register(): void
    {
        // Send a POST request to the registration endpoint with user data
        $response = $this->httpClient->post('/register', [
            'form_params' => [
                'username' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'password',
                'password_confirmation' => 'password',
            ],
        ]);

        // Check if the user is authenticated
        $this->assertTrue($this->isAuthenticated($response));

        // Check if the response redirects to the home route (assuming a 302 status)
        $this->assertEquals(302, $response->getStatusCode());
    }

    private function isAuthenticated($response): bool
    {
        $cookies = $response->getHeader('Set-Cookie');
        $isAuthenticated = false;

        foreach ($cookies as $cookie) {
            if (strpos($cookie, 'laravel_session') !== false) {
                $isAuthenticated = true;
                break;
            }
        }

        return $isAuthenticated;
        return true;
    }
}