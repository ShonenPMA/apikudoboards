<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KudoboardsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(config('kudoboard_types')),
            'title' => $this->faker->name(),
            'kudoable_type' => $this->faker->name(),
            'kudoable_id' => $this->faker->randomNumber()
        ];
    }
}
