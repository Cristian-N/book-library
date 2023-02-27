<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class WorkFactory extends Factory
{
    public function definition(): array
    {
        return [
            'w_id' => $this->faker->unique()->randomNumber(5),
            'title' => $this->faker->name(),
            'author' => json_encode($this->faker->words(3, false)),
            'subjects' => json_encode($this->faker->words(3, false)),
            'subject_places' => json_encode($this->faker->words(3, false)),
            'links' => json_encode($this->faker->words(3, false)),
            'covers' => json_encode($this->faker->words(3, false)),
            'description' => $this->faker->sentence(12, true),
            'notes' => $this->faker->sentence(12, true),
            'first_publish_date' => $this->faker->date(),
        ];
    }
}
