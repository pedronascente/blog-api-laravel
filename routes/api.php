<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes - Blog API v1
|--------------------------------------------------------------------------
|
| Todas as rotas estão versionadas em /api/v1
| Rotas protegidas usam JWT (auth:api)
|
*/

Route::prefix('v1')->group(function () {

    // -----------------------------
    // Autenticação (públicas)
    // -----------------------------
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // -----------------------------
    // Rotas públicas
    // -----------------------------
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/{post}', [PostController::class, 'show']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    Route::get('posts/{post}/comments', [CommentController::class, 'index']);

    // -----------------------------
    // Rotas protegidas (JWT)
    // -----------------------------
    Route::middleware('auth:api')->group(function () {

        // Auth
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']); // Retorna usuário logado

        // Posts
        Route::post('posts', [PostController::class, 'store']);
        Route::put('posts/{post}', [PostController::class, 'update']);
        Route::delete('posts/{post}', [PostController::class, 'destroy']);

        // Comments
        Route::post('posts/{post}/comments', [CommentController::class, 'store']);
        Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

        Route::post('categories', [CategoryController::class, 'store']);
        Route::put('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

    });

});


Route::get('/ping', function () {
    return response()->json(['message' => 'API funcionando no Laravel 12 🚀']);
});
