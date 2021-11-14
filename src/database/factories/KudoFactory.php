<?php

namespace Database\Factories;

use App\Models\Kudoboards;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class KudoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text('20'),
            'kudoboard_id' => Kudoboards::factory(),
            'user_sender_id' => User::factory(),
            'user_receiver_id' => User::factory(),
        ];
    }
}
