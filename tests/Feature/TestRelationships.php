<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Edition;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestRelationships extends TestCase
{
    use RefreshDatabase;

    public function test_works_editions_authors_relations_work_as_intended()
    {
        $works = Work::factory(10)
            ->has(Edition::factory()->count(5))
            ->has(Author::factory()->count(1))
            ->create();

        $this->assertCount(10, $works);
        $this->assertCount(5, $works->first()->editions);
        $this->assertCount(1, $works->first()->authors);
    }
}
