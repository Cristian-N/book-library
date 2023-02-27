<?php

namespace App\Http\Services;

use App\Models\Work;

class WorkService
{
    public function single($workId)
    {
        return Work::where('w_id', $workId)->first();
    }
}
