<?php

use App\Http\Controllers\Site\WorkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/book/{bookId}/{slug}', [WorkController::class, 'single'])
    ->missing(function (Request $request) {
        // this could return closure of a service that can conditionally
        // return a category or most read books
        return view('errors.404');
    });

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
