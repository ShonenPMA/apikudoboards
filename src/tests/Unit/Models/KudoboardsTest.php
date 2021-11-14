<?php

namespace Tests\Unit\Models;

use App\Models\Kudoboards;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KudoboardsTest extends TestCase
{
    use RefreshDatabase;
    private $kudoboard;
    public function setUp() :void
    {
        parent::setUp();
        $this->kudoboard = Kudoboards::factory()->create();
       
    }

    public function test_kudoboard_belongs_to_a_user()
    {
        User::factory()->create();
        $kudoboard = Kudoboards::factory()->create([
            'kudoable_type' => User::class,
            'kudoable_id' => 1
        ]);

        $this->assertInstanceOf(User::class, $kudoboard->kudoable);
    }

    public function test_kudoboard_belongs_to_a_project()
    {
        Project::factory()->create();
        $kudoboard = Kudoboards::factory()->create([
            'kudoable_type' => Project::class,
            'kudoable_id' => 1
        ]);

        $this->assertInstanceOf(Project::class, $kudoboard->kudoable);
    }

    public function test_kudoboard_belongs_to_a_team()
    {
        Team::factory()->create();
        $kudoboard = Kudoboards::factory()->create([
            'kudoable_type' => Team::class,
            'kudoable_id' => 1
        ]);

        $this->assertInstanceOf(Team::class, $kudoboard->kudoable);
    }

    public function test_kudoboard_has_many_kudos()
    {
        $this->assertInstanceOf(Collection::class, $this->kudoboard->kudos);
    }
}
