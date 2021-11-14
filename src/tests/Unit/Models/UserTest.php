<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    public function setUp() : void
    {
        parent::setUp();
        $this->user = new User();
    }

    public function test_user_has_many_projects()
    {
        $this->assertInstanceOf(Collection::class, $this->user->projects);
    }
    
    public function test_user_has_many_teams()
    {
        $this->assertInstanceOf(Collection::class, $this->user->teams);
    }
    
    public function test_user_has_many_project_users()
    {
        $this->assertInstanceOf(Collection::class, $this->user->projectUsers);
    }

    public function test_user_has_many_team_users()
    {
        $this->assertInstanceOf(Collection::class, $this->user->teamUsers);
    }
}
