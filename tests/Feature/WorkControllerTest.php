<?php

namespace Tests\Feature;

use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_single_work_page_is_available()
    {
        $workFactory = Work::factory()->create()->first();

        $response = $this->get('/book/'.$workFactory->w_id.'/test-slug');

        $response->assertStatus(200);
    }
}
