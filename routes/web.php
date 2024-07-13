<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PublicInformationController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product', [ProductController::class, 'homeProduct'])->name('home.product');
Route::get('/product/detail/{id}/{slug}', [ProductController::class, 'homeProductDetail'])->name('home.product.detail');
Route::get('/article', [ArticleController::class, 'homeArticle'])->name('home.article');
Route::get('/article/detail/{id}/{slug}', [ArticleController::class, 'homeArticleDetail'])->name('home.article.detail');
Route::get('/gallery', [GalleryController::class, 'homeGallery'])->name('home.gallery');
Route::get('/team', [TeamController::class, 'homeTeam'])->name('home.team');
Route::get('/testimonial', [ReviewController::class, 'homeReview'])->name('home.testimonial');
Route::get('/contact', [ContactController::class, 'homeContact'])->name('home.contact');

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
    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');
    Route::get('team', [TeamController::class, 'index'])->name('team');
    Route::get('review', [ReviewController::class, 'index'])->name('review');
    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    Route::get('public-information', [PublicInformationController::class, 'index'])->name('public-information');
    Route::get('about', [AboutController::class, 'index'])->name('about');
    Route::get('about/webinfo', [AboutController::class, 'webinfo'])->name("about.webinfo");
    Route::get('about/sosmed', [AboutController::class, 'sosmed'])->name("about.sosmed");
    Route::get('account', [AuthController::class, 'account'])->name('account');
    Route::get('user', [UserController::class, 'index'])->name('user');
});
