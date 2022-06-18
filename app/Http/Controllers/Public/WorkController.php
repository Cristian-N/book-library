<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Services\WorkService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Throwable;

class WorkController extends Controller
{
    public function __construct(
        private readonly WorkService $workService
    ) { }

    public function __invoke(Request $request): View
    {
        $workId = $request->route('bookId');

        $work = $this->workService->single($workId);

        if (is_null($work)) {
            abort(404);
        }

        return view('public/work', $work->toArray());
    }
}
