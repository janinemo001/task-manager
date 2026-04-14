<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     *  Test user registration
     */
    public function test_user_can_register(): void
    {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Nine',
            'email' => 'nine@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);
    }

    /**
     *  Test user login
     */
    public function test_user_can_login(): void
    {
        $user = \App\Models\User::factory()->create([
            'password' => bcrypt('123456768')
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => '123456768'
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'user',
                    'token'
                ]
            ]);
    }

    /**
     *  Test user can get me
     */
    public function test_user_can_get_me(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->getJson('/api/v1/auth/me');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email'
                ]
            ]);
    }

    /**
     *  Test user can logout
     */
    public function test_user_can_logout(): void
    {
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
            ->postJson('/api/v1/auth/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Logged out successfully'
            ]);
    }

    /**
     *  Test user cannot login with wrong password
     */
    public function test_user_cannot_login_with_wrong_password(): void
    {
        $this->withExceptionHandling();

        $user = \App\Models\User::factory()->create([
            'password' => bcrypt('12345678')
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ]);

        $response->assertStatus(400)
            ->assertJson([
                'message' => 'Invalid credentials provided.'
            ]);
    }

    /**
     *  Test register requires fields
     */

    public function test_register_requires_fields(): void
    {
        $response = $this->postJson('/api/v1/auth/register', []);

        $response->assertStatus(422)
            ->assertJsonStructure([
                'message',
                'errors'
            ]);
    }

    /**
     *  Test login requires fields
     */
    public function test_login_requires_fields(): void
    {
        $response = $this->getJson('/api/v1/auth/me');

        $response->assertStatus(401);
    }
}
