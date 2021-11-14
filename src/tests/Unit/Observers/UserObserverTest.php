<?php

namespace Tests\Unit\Observers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserObserverTest extends TestCase
{
    use RefreshDatabase;
    public function test_create_two_kudoboards_when_user_is_created()
    {
        $user = User::factory()->create();

        $this->assertDatabaseCount('kudoboards', 2);
        $this->assertDatabaseHas('kudoboards', [
            'type' => 'user',
            'kudoable_id' => $user->id
        ]);
        $this->assertDatabaseHas('kudoboards', [
            'type' => 'birthday',
            'kudoable_id' => $user->id
        ]);
    }
}
