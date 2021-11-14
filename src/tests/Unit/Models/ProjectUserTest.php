<?php

namespace Tests\Unit\Models;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectUserTest extends TestCase
{
    use RefreshDatabase;
    private $projectUser;
    public function setUp() :void
    {
        parent::setUp();
        $this->projectUser = ProjectUser::factory()->create();
    }

    public function test_project_user_belongs_to_an_user()
    {
        $this->assertInstanceOf(User::class, $this->projectUser->user);
    }

    public function test_project_user_belongs_to_a_project()
    {
        $this->assertInstanceOf(Project::class, $this->projectUser->project);
    }
}
