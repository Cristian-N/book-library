<?php

namespace Database\Factories;

use App\Models\Work;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class EditionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'e_id' => $this->faker->unique()->randomNumber(5),
            'work_id' => Work::factory(),
            'title' => $this->faker->words(5, true),
            'subtitle' => $this->faker->words(5, true),
            'title_prefix' => $this->faker->words(5, true),
            'other_titles' => json_encode($this->faker->words(3, false)),
            'authors' => json_encode($this->faker->words(3, false)),
            'by_statement' => json_encode($this->faker->words(3, false)),
            'publish_date' => $this->faker->date(),
            'copyright_date' => $this->faker->date(),
            'edition_name' => $this->faker->words(5, true),
            'languages' => json_encode($this->faker->words(3, false)),
            'first_sentence' => $this->faker->sentence(12, true),
            'description' => $this->faker->sentence(12, true),
            'notes' => $this->faker->sentence(12, true),
            'genres' => json_encode($this->faker->words(3, false)),
            'table_of_contents' => json_encode($this->faker->words(3, false)),
            'work_titles' => json_encode($this->faker->words(3, false)),
            'series' => json_encode($this->faker->words(3, false)),
            'physical_dimensions' => $this->faker->words(2, true),
            'physical_format' => $this->faker->words(2, true),
            'number_of_pages' => $this->faker->words(1, true),
            'subjects' => json_encode($this->faker->words(3, false)),
            'pagination' => $this->faker->randomDigit(),
            'lccn' => json_encode($this->faker->words(3, false)),
            'ocaid' => $this->faker->words(2, true),
            'oclc_numbers' => json_encode($this->faker->words(3, false)),
            'isbn_10' => json_encode($this->faker->words(3, false)),
            'isbn_13' => json_encode($this->faker->words(3, false)),
            'dewey_decimal_class' => json_encode($this->faker->words(3, false)),
            'lc_classifications' => json_encode($this->faker->words(3, false)),
            'contributions' => json_encode($this->faker->words(3, false)),
            'publish_places' => json_encode($this->faker->words(3, false)),
            'publish_country' => $this->faker->country(),
            'publishers' => json_encode($this->faker->words(3, false)),
            'distributors' => json_encode($this->faker->words(3, false)),
            'weight' => $this->faker->words(2, true),
            'location' => json_encode($this->faker->words(3, false)),
            'collections' => json_encode($this->faker->words(3, false)),
            'uris' => json_encode($this->faker->words(3, false)),
            'uri_descriptions' => json_encode($this->faker->words(3, false)),
            'translation_of' => $this->faker->words(3, true),
            'works' => json_encode($this->faker->words(3, false)),
            'source_records' => json_encode($this->faker->words(3, false)),
            'translated_from' => json_encode($this->faker->words(3, false)),
            'scan_records' => json_encode($this->faker->words(3, false)),
            'volumes' => json_encode($this->faker->words(3, false)),
        ];
    }
}
