<?php

namespace App\Http\DTO;

class EditionData
{
    public function __construct(
        public string $key,
        public ?string $work_id,
        public string $title,
        public ?string $subtitle,
        public ?string $title_prefix,
        public ?array $other_titles,
        public ?array $authors,
        public ?array $identifiers,
        public ?string $by_statement,
        public ?string $publish_date,
        public ?string $copyright_date,
        public ?string $edition_name,
        public ?array $languages,
        public ?string $description,
        public ?string $notes,
        public ?array $genres,
        public ?array $table_of_contents,
        public ?array $work_titles,
        public ?array $series,
        public ?string $physical_dimensions,
        public ?string $physical_format,
        public ?string $number_of_pages,
        public ?array $subjects,
        public ?string $pagination,
        public ?array $lccn,
        public ?string $ocaid,
        public ?array $oclc_numbers,
        public ?array $isbn_10,
        public ?array $isbn_13,
        public ?array $dewey_decimal_class,
        public ?array $lc_classifications,
        public ?array $contributions,
        public ?array $publish_places,
        public ?string $publish_country,
        public ?array $publishers,
        public ?array $distributors,
        public ?string $first_sentence,
        public ?string $weight,
        public ?array $location,
        public ?array $collections,
        public ?array $uris,
        public ?array $uri_descriptions,
        public ?string $translation_of,
        public ?array $works,
        public ?array $source_records,
        public ?array $translated_from,
        public ?array $scan_records,
        public ?array $volumes,
    ) {
        //
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
