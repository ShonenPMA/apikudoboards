<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    private $project;
    public function setUp() :void
    {
        parent::setUp();
        $this->project = Project::factory()->create();
    }

    public function test_project_belongs_to_a_user()
    {
        $this->assertInstanceOf(User::class, $this->project->user);
    }

    public function test_project_has_many_project_users()
    {
        $this->assertInstanceOf(Collection::class, $this->project->projectUsers);
    }
}
