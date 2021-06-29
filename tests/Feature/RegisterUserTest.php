<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    public function test_check_if_email_already_exist() {
        $credentials =[
            'email' => 'm@m.com',
            'password' => 'asdfasdf'
        ];
        $response = $this->postJson('/api/register', $credentials);

        $response->assertStatus(422);
    }

    public function test_user_registered_successfully() {
        $user = new User;
        $user->email = 'test@test.com';
        $user->password = Hash::make('asdfasdf');
        $user->save();

        //check if successfully save in orders table
        $this->assertDatabaseHas('users', [
            'id' => $user->id
        ]);
    }

}
