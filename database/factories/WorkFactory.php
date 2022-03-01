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
            'w_id' => $this->faker->word(),
            'title' => $this->faker->name(),
            'subtitle' => $this->faker->words(5, true),
            'authors' => json_encode($this->faker->words(3, false)),
            'translated_titles' => json_encode($this->faker->words(3, false)),
            'subjects' => json_encode($this->faker->words(3, false)),
            'subject_places' => json_encode($this->faker->words(3, false)),
            'subject_times' => json_encode($this->faker->words(3, false)),
            'subject_people' => json_encode($this->faker->words(3, false)),
            'dewey_number' => json_encode($this->faker->words(3, false)),
            'lc_classifications' => json_encode($this->faker->words(3, false)),
            'original_languages' => json_encode($this->faker->words(3, false)),
            'other_titles' => json_encode($this->faker->words(3, false)),
            'links' => json_encode($this->faker->words(3, false)),
            'covers' => json_encode($this->faker->words(3, false)),
            'cover_edition' => $this->faker->word(),
            'first_sentence' => $this->faker->sentence(12, true),
            'description' => $this->faker->sentence(12, true),
            'notes' => $this->faker->sentence(12, true),
            'first_publish_date' => $this->faker->date(),
        ];
    }
}
