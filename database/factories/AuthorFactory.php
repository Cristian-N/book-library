<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class AuthorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'a_id' => $this->faker->word(),
            'name' => $this->faker->name(),
            'eastern_order' => $this->faker->boolean(),
            'personal_name' => $this->faker->name(),
            'enumeration' => $this->faker->words(5),
            'title' => $this->faker->words(5),
            'alternate_names' => json_encode($this->faker->words(3, false)),
            'uris' => json_encode($this->faker->words(3, false)),
            'bio' => $this->faker->sentence(5),
            'location' => $this->faker->words(),
            'birth_date' => $this->faker->date(),
            'death_date' => $this->faker->date(),
            'date' => $this->faker->date(),
            'wikipedia' => $this->faker->words(),
            'links' => json_encode($this->faker->words(3, false)),
        ];
    }
}
