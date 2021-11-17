<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Team;
use App\Models\TeamUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Project::factory()
            ->has(ProjectUser::factory()->count(10))
            ->create();
        
        Team::factory()
            ->has(TeamUser::factory()->count(10))
            ->create();
    }
}
