<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_register_with_valid_data()
    {
        $data = [
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => 'Password123',
        ];

        $response = $this->withoutMiddleware()->post('/register', $data);

        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'name' => 'johndoe',
            'email' => 'john@example.com',
        ]);

        $user = User::where('email', 'john@example.com')->first();
        $this->assertTrue(Hash::check('Password123', $user->password));
    }

    /** @test */
    public function registration_requires_username()
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'email' => 'test@example.com',
            'password' => 'Password123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function password_must_contain_uppercase_lowercase_and_number()
    {
        // Missing uppercase
        $response = $this->withoutMiddleware()->post('/register', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('password');

        // Missing lowercase
        $response = $this->withoutMiddleware()->post('/register', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'PASSWORD123',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('password');

        // Missing number
        $response = $this->withoutMiddleware()->post('/register', [
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'Password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('password');
    }
}
