<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Site\FrontPageController;
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


// SITE
Route::get('/', FrontPageController::class);

// ADMIN
Route::get('/admin/dashboard', AdminController::class)->middleware(['auth', 'verified'])->name('admin-dashboard');

// EDITOR
Route::get('/editor/dashboard', FrontPageController::class)->middleware(['auth', 'verified'])->name('editor-dashboard');

// USER
Route::get('/u/profile', FrontPageController::class)->middleware(['auth', 'verified'])->name('user-profile');
Route::get('/a/profile', FrontPageController::class)->middleware(['auth', 'verified'])->name('author-profile');

// AUTHENTICATION
require __DIR__.'/auth.php';
