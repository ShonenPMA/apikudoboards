<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Exceptions\Auth\BadCredentials;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    const AUTH_PATH = 'api/auth';
    
    public function test_can_register_user()
    {        
        $data = [
            'name' => 'shonen',
            'email' => 'shonen@example.test',
            'birth_date' => '1990-01-01',
            'password' => '123456Aa*',
            'password_confirmation' => '123456Aa*'
        ];

        $response = $this->json('POST', self::AUTH_PATH . "/register", $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'token'
            ]
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $data['email'],
            'name' => $data['name'],
            'birth_date' => $data['birth_date'],
        ]);
    }

    public function test_can_login_user()
    {        
        User::factory()->create([
            'email' => 'shonen@example.test'
        ]);

        $data = [
            'email' => 'shonen@example.test',
            'password' => 'password'
        ];
        $response = $this->json('POST', self::AUTH_PATH . "/login", $data);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                'token'
            ]
        ]);
    }

    public function test_can_throw_bad_credentials_exception_when_login_failed()
    {        
        User::factory()->create([
            'email' => 'shonen@example.test'
        ]);

        $data = [
            'email' => 'shonen@example.test',
            'password' => 'passwords'
        ];
        $this->withoutExceptionHandling();
        $this->expectException(BadCredentials::class);
        $this->json('POST', self::AUTH_PATH . "/login", $data);

    }
}
