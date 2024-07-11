<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// AUTH
Route::group(["middleware" => "guest"], function () {
    Route::get('/kelola', [AuthController::class, 'login'])->name('login');
});

// Dashboard
Route::prefix('admin')->namespace('admin')->middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // MASTER
    Route::get('article', [ArticleController::class, 'index'])->name("article");
    Route::get('slide', [SlideController::class, 'index'])->name('slide');
});
