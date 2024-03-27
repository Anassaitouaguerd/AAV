<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    // use RefreshDatabase;
    public function test_user_can_be_created()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ];
        $response = $this->postJson('/api/User', $userData);
        $response->assertStatus(201);
        $this->assertCount(1, User::all());
    }
}