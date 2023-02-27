<?php

namespace App\Http\Controllers\Site;

class FrontPageController
{
    public function __invoke()
    {
        return view('welcome');
    }
}
