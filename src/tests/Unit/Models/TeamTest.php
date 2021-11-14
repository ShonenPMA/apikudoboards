<?php

namespace Tests\Unit\Models;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    public function test_team_belongs_to_a_user()
    {
        $team = Team::factory()->create();
        $this->assertInstanceOf(User::class, $team->user);
    }
}
