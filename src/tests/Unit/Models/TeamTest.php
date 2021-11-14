<?php

namespace Tests\Unit\Models;

use App\Models\Kudoboards;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    private $team;

    public function setUp() : void
    {
        parent::setUp();
        $this->team = Team::factory()->create();
    }
    public function test_team_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->team->user);
    }

    public function test_team_has_many_team_users()
    {
        $this->assertInstanceOf(Collection::class, $this->team->teamUsers);
    }

    public function test_team_has_one_kudoboard()
    {
        $this->assertInstanceOf(Kudoboards::class, $this->team->kudoboard);
    }
}
