<?php

namespace Tests\Feature\Http\Controllers\API;

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

        $response = $this->json('POST', self::AUTH_PATH . "/register", $data)->dump();

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
        ]);;
    }
}
