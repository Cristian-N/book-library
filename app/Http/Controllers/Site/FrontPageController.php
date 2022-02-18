<?php

namespace App\Http\Controllers\Site;

use Illuminate\Foundation\Application;
use Inertia\Inertia;
use Route;

class FrontPageController
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('FrontPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
