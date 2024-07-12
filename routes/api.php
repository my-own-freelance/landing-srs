<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomTemplateController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PublicInformationController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH
Route::group(["middleware" => "guest"], function () {
    Route::post("/auth/login", [AuthController::class, "validateLogin"]);
    Route::get("/contact/create", [ContactController::class, "create"]);
});

Route::prefix("admin")->namespace("admin")->middleware("check.auth")->group(function () {
    Route::post("/custom_template/create_update", [CustomTemplateController::class, "saveUpdateData"]);

    // ARTICLE
    Route::group(["prefix" => "article"], function () {
        Route::get("datatable", [ArticleController::class, "dataTable"]);
        Route::get("{id}/detail", [ArticleController::class, "getDetail"]);
        Route::post("create", [ArticleController::class, "create"]);
        Route::post("update", [ArticleController::class, "update"]);
        Route::post("update-status", [ArticleController::class, "updateStatus"]);
        Route::delete("/", [ArticleController::class, "destroy"]);
    });

    // SLIDE
    Route::group(["prefix" => "slide"], function () {
        Route::get("datatable", [SlideController::class, "dataTable"]);
        Route::get("{id}/detail", [SlideController::class, "getDetail"]);
        Route::post("create", [SlideController::class, "create"]);
        Route::post("update", [SlideController::class, "update"]);
        Route::post("update-status", [SlideController::class, "updateStatus"]);
        Route::delete("/", [SlideController::class, "destroy"]);
    });

    // ARTICLE
    Route::group(["prefix" => "product"], function () {
        Route::get("datatable", [ProductController::class, "dataTable"]);
        Route::get("{id}/detail", [ProductController::class, "getDetail"]);
        Route::post("create", [ProductController::class, "create"]);
        Route::post("update", [ProductController::class, "update"]);
        Route::post("update-status", [ProductController::class, "updateStatus"]);
        Route::delete("/", [ProductController::class, "destroy"]);
    });

    // GALLERY
    Route::group(["prefix" => "gallery"], function () {
        Route::get("datatable", [GalleryController::class, "dataTable"]);
        Route::get("{id}/detail", [GalleryController::class, "getDetail"]);
        Route::post("create", [GalleryController::class, "create"]);
        Route::post("update", [GalleryController::class, "update"]);
        Route::post("update-status", [GalleryController::class, "updateStatus"]);
        Route::delete("/", [GalleryController::class, "destroy"]);
    });

    // TEAM
    Route::group(["prefix" => "team"], function () {
        Route::get("datatable", [TeamController::class, "dataTable"]);
        Route::get("{id}/detail", [TeamController::class, "getDetail"]);
        Route::post("create", [TeamController::class, "create"]);
        Route::post("update", [TeamController::class, "update"]);
        Route::delete("/", [TeamController::class, "destroy"]);
    });

    // REVIEW
    Route::group(["prefix" => "review"], function () {
        Route::get("datatable", [ReviewController::class, "dataTable"]);
        Route::get("{id}/detail", [ReviewController::class, "getDetail"]);
        Route::post("create", [ReviewController::class, "create"]);
        Route::post("update", [ReviewController::class, "update"]);
        Route::delete("/", [ReviewController::class, "destroy"]);
    });

    // CONTACT
    Route::group(["prefix" => "contact"], function () {
        Route::get("datatable", [ContactController::class, "dataTable"]);
        Route::get("{id}/detail", [ContactController::class, "getDetail"]);
        Route::delete("/", [ContactController::class, "destroy"]);
    });

    // PUBLIC INFORMATION
    Route::group(["prefix" => "public-information"], function () {
        Route::get("/detail", [PublicInformationController::class, 'getDetail']);
        Route::post("/create-update", [PublicInformationController::class, 'createAndUpdate']);
    });

    // AVIYT
    Route::group(["prefix" => "about"], function () {
        Route::get("/detail", [AboutController::class, 'getDetail']);
        Route::post("/create-update", [AboutController::class, 'createAndUpdate']);
    });

    // CHANGE PASS
    Route::group(["prefix" => "user"], function () {
        Route::get("/detail", [AuthController::class, "detail"]);
        Route::post("/update", [AuthController::class, "update"]);
    });

    // USER
    Route::group(["prefix" => "user"], function () {
        Route::get("datatable", [UserController::class, "dataTable"]);
        Route::get("{id}/detail", [UserController::class, "getDetail"]);
        Route::post("/create", [UserController::class, "create"]);
        Route::post("/update", [UserController::class, "update"]);
        Route::post("/update-status", [UserController::class, "updateStatus"]);
        Route::delete("/", [UserController::class, "destroy"]);
    });
});
