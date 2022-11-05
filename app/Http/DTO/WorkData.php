<?php

namespace App\Http\DTO;

class WorkData
{
    public function __construct(
        public string $key,
        public string $title,
        public ?string $subtitle,
        public array $authors,
        public ?array $translated_titles,
        public ?array $subjects,
        public ?array $subject_places,
        public ?array $subject_times,
        public ?array $subject_people,
        public ?array $dewey_number,
        public ?array $lc_classifications,
        public ?array $original_languages,
        public ?array $other_titles,
        public ?array $links,
        public ?array $covers,
        public ?string $cover_edition,
        public ?string $first_sentence,
        public ?string $description,
        public ?string $notes,
        public ?string $first_publish_date,
        public ?string $created_date,
        public ?string $last_modified,
    ) {
        //
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
