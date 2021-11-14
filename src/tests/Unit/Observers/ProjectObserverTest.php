<?php

namespace Tests\Unit\Observers;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectObserverTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_one_kudoboard_when_project_is_created()
    {
        $project = Project::factory()->create();

        $this->assertDatabaseCount('kudoboards', 2+1); //kudos of user + kudo project
        $this->assertDatabaseHas('kudoboards', [
            'type' => 'project',
            'kudoable_id' => $project->id
        ]);
    }
}
