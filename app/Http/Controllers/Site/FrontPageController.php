<?php

namespace App\Http\Controllers\Site;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\View;
use Route;

class FrontPageController
{
    public function __invoke()
    {
        return view('welcome');
    }
}
