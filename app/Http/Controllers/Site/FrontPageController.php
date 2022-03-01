<?php

namespace App\Http\Controllers\Site;

use Illuminate\Foundation\Application;
use Inertia\Inertia;
use Inertia\Response;
use Route;

class FrontPageController
{
    public function __invoke(): Response
    {
        return Inertia::render('FrontPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
