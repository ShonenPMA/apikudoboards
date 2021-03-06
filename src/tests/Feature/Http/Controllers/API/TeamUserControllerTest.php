<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Exceptions\TeamUser\TeamOwnerCanNotBeAMember;
use App\Exceptions\TeamUser\ShouldBeTheTeamOwner;
use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TeamUserControllerTest extends TestCase
{
    use RefreshDatabase;
    const PATH = 'api/teamUser';
    private $user;
    private $team;
    public function setUp() : void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->team = Team::factory()->create([
            'user_id' => $this->user->id
        ]);

        Sanctum::actingAs(
            $this->user
        );
    }

    public function test_can_register_team_user()
    {
        $member = User::factory()->create();

        $data = [
            'user_id' => $member->id,
            'team_id' => $this->team->id
        ];
        
        $response = $this->json('POST', self::PATH, $data);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('team_users', [
            'user_id' => $data['user_id'],
            'team_id' => $data['team_id'],
        ]);
    }
    public function test_can_not_register_team_user_if_auth_user_is_not_team_owner()
    {
        $member = User::factory()->create();
        $team = Team::factory()->create();
        $data = [
            'user_id' => $member->id,
            'team_id' => $team->id
        ];
        $this->withoutExceptionHandling();
        $this->expectException(ShouldBeTheTeamOwner::class);
        $this->json('POST', self::PATH, $data);
    }
    public function test_can_not_register_team_user_if_the_new_member_is_the_team_owner()
    {
        $data = [
            'user_id' => $this->user->id,
            'team_id' => $this->team->id
        ];
        $this->withoutExceptionHandling();
        $this->expectException(TeamOwnerCanNotBeAMember::class);
        $this->json('POST', self::PATH, $data);
    }
    public function test_can_delete_team_user()
    {
        $teamUser = TeamUser::factory()->create();
        $this->withoutExceptionHandling();
        $response = $this->json('DELETE', self::PATH . "/{$teamUser->id}");

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseMissing('team_users', [
            'name' => $teamUser->name
        ]);
    }
    public function test_can_list_teams_users_from_a_team()
    {
        $team_users = TeamUser::factory()->create([
            'team_id' => $this->team->id
        ]);

        $response = $this->json('GET', self::PATH . "/{$this->team->id}");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonCount($team_users->count(), 'data');
    }
    public function test_can__not_list_teams_users_from_a_team_if_auth_user_is_not_owner()
    {
        $other_team = Team::factory()->create();
        TeamUser::factory()->create([
            'team_id' => $other_team->id
        ]);

        $this->withoutExceptionHandling();
        $this->expectException(ShouldBeTheTeamOwner::class);
        $this->json('GET', self::PATH . "/{$other_team->id}");

    }

}
