<?php

namespace App\Http\DTO;

class EditionUpdateData
{
    public function __construct(
        public string $key,
        public ?array $authors,
        public ?array $languages,
        public ?array $works,
    ) {
        //
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
