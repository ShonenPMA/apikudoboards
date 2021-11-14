<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class KudoboardControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/kudoboards';
    private $user;
    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Sanctum::actingAs(
            $this->user
        );
    }

    public function test_can_list_all_kudoboards_of_auth_user()
    {
        $projects = Project::factory(5)->create([
            'user_id' => $this->user->id
        ]);

        $teams = Team::factory(8)->create([
            'user_id' => $this->user->id
        ]);
        $total_expected = 2 + $projects->count() + $teams->count();

        $response = $this->json('GET', self::PATH);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($total_expected,'data');
    }
}
