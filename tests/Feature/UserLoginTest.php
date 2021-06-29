<?php

namespace Tests\Feature;

use App\User;
use Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    // use RefreshDatabase;

    public function test_user_if_successfully_logged_id() {

        $credentials =[
            'email' => 'm@m.com',
            'password' => 'asdfasdf'
        ];
        $response = $this->postJson('/api/auth/login', $credentials);

        $response->assertStatus(200);

    }

    public function test_user_invalid_credentials() {

        $credentials =[
            'email' => 'm@m.com',
            'password' => 'asdfasdfa'
        ];
        $response = $this->postJson('/api/auth/login', $credentials);

        $response->assertStatus(401);

    }
}
