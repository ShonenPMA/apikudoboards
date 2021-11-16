<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/user';

    public function setUp() : void
    {
        parent::setUp();
        Sanctum::actingAs(
            User::factory()->create()
        );
    }

    public function test_can_list_users_except_the_current_auth_user()
    {
        $users = User::factory(5)->create();
        $response = $this->json('GET', self::PATH . "/indexExceptAuth");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($users->count(), 'data');
    }

    public function test_can_list_users_from_a_project()
    {
        $usersTotal = 5;
        Project::factory()
            ->has(ProjectUser::factory()->count($usersTotal))
            ->create();
        $this->withoutExceptionHandling();
        $response = $this->json('GET', self::PATH . "/indexFromProject/1");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($usersTotal, 'data');
    }
}
