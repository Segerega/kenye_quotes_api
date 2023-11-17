<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class BearerTokenAuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private User $user;


    protected function setUp(): void
    {
        parent::setUp();

        // Creating a user and setting an API token.
        $this->user = User::factory()->create([
            'api_token' => $this->faker->uuid(), // Using a UUID for the API token.
        ]);
    }

    /**
     * Test access with a valid token.
     */
    public function testAccessWithValidToken()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->user->api_token,
        ])->getJson('/api/kanye-quote');

        $response->assertStatus(200);
    }

    /**
     * Test access with an invalid token.
     */
    public function testAccessWithInvalidToken()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer invalidToken',
        ])->getJson('/api/kanye-quote');

        $response->assertStatus(401); // Unauthorized
    }
}
