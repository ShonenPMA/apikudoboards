<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Exceptions\ProjectUser\ProjectOwnerCanNotBeAMember;
use App\Exceptions\ProjectUser\ShouldBeTheProjectOwner;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectUserControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/projectUser';
    private $user;
    private $project;
    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->project = Project::factory()->create([
            'user_id' => $this->user->id
        ]);

        Sanctum::actingAs(
            $this->user
        );
    }

    public function test_can_register_project_user()
    {
        $member = User::factory()->create();

        $data = [
            'user_id' => $member->id,
            'project_id' => $this->project->id
        ];
        
        $response = $this->json('POST', self::PATH, $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('project_users', [
            'user_id' => $data['user_id'],
            'project_id' => $data['project_id'],
        ]);
    }
    public function test_can_not_register_project_user_if_auth_user_is_not_project_owner()
    {
        $member = User::factory()->create();
        $project = Project::factory()->create();
        $data = [
            'user_id' => $member->id,
            'project_id' => $project->id
        ];
        $this->withoutExceptionHandling();
        $this->expectException(ShouldBeTheProjectOwner::class);
        $this->json('POST', self::PATH, $data);
    }
    public function test_can_not_register_project_user_if_the_new_member_is_the_project_owner()
    {
        $data = [
            'user_id' => $this->user->id,
            'project_id' => $this->project->id
        ];
        $this->withoutExceptionHandling();
        $this->expectException(ProjectOwnerCanNotBeAMember::class);
        $this->json('POST', self::PATH, $data);
    }

    public function test_can_delete_project_user()
    {
        $projectUser = ProjectUser::factory()->create();
        $this->withoutExceptionHandling();
        $response = $this->json('DELETE', self::PATH . "/{$projectUser->id}")->dump();

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('project_users', [
            'name' => $projectUser->name
        ]);
    }
}
