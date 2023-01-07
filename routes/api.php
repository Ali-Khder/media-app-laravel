<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GifController;
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

//Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/gifs/search', [GifController::class, 'search']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/slug/{title}', [ArticleController::class, 'find']);

//Protected routes
Route::group(
    [
        'middleware' => ['auth:api']
    ],
    function () {
        Route::get('/user/check', [AuthController::class, 'checkAuth']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/admin/articles', [ArticleController::class, 'getMyArticles']);
        Route::post('/admin/articles/gifs/add/{id}', [ArticleController::class, 'uploadGifs']);
        Route::post('/admin/articles', [ArticleController::class, 'store']);
    }
);
