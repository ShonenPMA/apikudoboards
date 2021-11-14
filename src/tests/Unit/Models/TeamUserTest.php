<?php

namespace Tests\Unit\Models;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamUserTest extends TestCase
{
    use RefreshDatabase;
    private $teamUser;
    public function setUp() :void
    {
        parent::setUp();
        $this->teamUser = TeamUser::factory()->create();
    }

    public function test_team_user_belongs_to_an_user()
    {
        $this->assertInstanceOf(User::class, $this->teamUser->user);
    }

    public function test_team_user_belongs_to_a_team()
    {
        $this->assertInstanceOf(Team::class, $this->teamUser->team);
    }
}
