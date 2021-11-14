<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/team';
    private $user;
    public function setUp() : void
    {
        parent::setUp();

        $this->user =User::factory()->create();
        Sanctum::actingAs(
            $this->user
        );
    }

    public function test_can_register_team()
    {
        $data = [
            'name' => 'Taka'
        ];
        
        $response = $this->json('POST', self::PATH, $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('teams', [
            'name' => $data['name']
        ]);
    }

}
