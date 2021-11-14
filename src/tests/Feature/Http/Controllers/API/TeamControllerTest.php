<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Team;
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

    public function test_can_update_team()
    {
        $team = Team::factory()->create();
        $data = [
            'name' => 'Akatsuki'
        ];
        
        $this->withoutExceptionHandling();
        $response = $this->json('PUT', self::PATH . "/{$team->id}", $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('teams', [
            'name' => $data['name']
        ]);
    }

    public function test_can_delete_team()
    {
        $team = Team::factory()->create();
        
        $response = $this->json('DELETE', self::PATH . "/{$team->id}");

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('teams', [
            'name' => $team->name
        ]);
    }

    public function test_can_list_teams_from_auth_user()
    {
        $teams = Team::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->withoutExceptionHandling();
        $response = $this->json('GET', self::PATH . "/indexFromAuthUser");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($teams->count(), 'data');
    }
}
