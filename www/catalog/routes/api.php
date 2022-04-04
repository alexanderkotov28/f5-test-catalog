<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category_id}/posts', [CategoryController::class, 'postsByCategoryId']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/post/{post}', [PostController::class, 'show']);
});
