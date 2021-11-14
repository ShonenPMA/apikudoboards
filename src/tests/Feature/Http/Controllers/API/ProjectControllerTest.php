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

    public function setUp() : void
    {
        parent::setUp();

        Sanctum::actingAs(
            User::factory()->create()
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
}
