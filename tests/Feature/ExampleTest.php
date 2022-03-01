<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Edition;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $works = Work::factory()->create();
        $editions = Edition::factory()->create();
        $authors = Author::factory()->create();

        dump($works);
        dump($editions);
        dump($authors);

        $this->assertTrue(true);
    }
}
