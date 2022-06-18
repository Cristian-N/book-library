<?php

namespace Tests\Feature;

use App\Http\Services\WorkService;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_work_service_get_single_item_successfully()
    {
        $workFactory = Work::factory()->create()->first();

        $workService = (new WorkService())->single($workFactory->w_id);

        $this->assertEquals($workFactory->w_id, $workService->w_id);
    }
}
