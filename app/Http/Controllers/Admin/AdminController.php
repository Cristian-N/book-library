<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;

class AdminController
{
    public function __invoke(): \Inertia\Response
    {
        return Inertia::render('Dashboard');
    }
}
