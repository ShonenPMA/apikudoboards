<?php

namespace Tests\Unit\Observers;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamObserverTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_one_kudoboard_when_team_is_created()
    {
        $team = Team::factory()->create();

        $this->assertDatabaseCount('kudoboards', 2+1); //kudos of user + kudo team
        $this->assertDatabaseHas('kudoboards', [
            'type' => 'team',
            'kudoable_id' => $team->id
        ]);
    }
}
