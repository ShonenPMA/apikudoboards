<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/project';
    private $user;
    public function setUp() : void
    {
        parent::setUp();

        $this->user =User::factory()->create();
        Sanctum::actingAs(
            $this->user
        );
    }

    public function test_can_register_project()
    {
        $data = [
            'name' => 'Taka'
        ];
        
        $response = $this->json('POST', self::PATH, $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('projects', [
            'name' => $data['name']
        ]);
    }
    public function test_can_update_project()
    {
        $project = Project::factory()->create();
        $data = [
            'name' => 'Akatsuki'
        ];
        
        $this->withoutExceptionHandling();
        $response = $this->json('PUT', self::PATH . "/{$project->id}", $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('projects', [
            'name' => $data['name']
        ]);
    }

    public function test_can_delete_project()
    {
        $project = Project::factory()->create();
        
        $response = $this->json('DELETE', self::PATH . "/{$project->id}");

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('projects', [
            'name' => $project->name
        ]);
    }

    public function test_can_list_projects_from_auth_user()
    {
        $projects = Project::factory()->create([
            'user_id' => $this->user->id
        ]);

        $this->withoutExceptionHandling();
        $response = $this->json('GET', self::PATH . "/indexFromAuthUser");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($projects->count(), 'data');
    }
}
