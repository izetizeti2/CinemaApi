<?php

// routes/api.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Api\UserController;


Route::post('/login', [AuthController::class, 'login']);



Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Logout route
    Route::post('/logout', [AuthController::class, 'logout']);

    // Vetëm adminët mund të marrin listën e përdoruesve
    Route::middleware(AdminMiddleware::class)->group(function () {

        // Këto rrota janë për administratoret
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
        
        Route::post('/movies', [MovieController::class, 'store']);
        Route::put('/movies/{id}', [MovieController::class, 'update']);
        Route::delete('/movies/{id}', [MovieController::class, 'destroy']);

        Route::get('/users', [UserController::class, 'getUsers']);
        Route::get('/users/{id}', [UserController::class, 'getUserById']);
        Route::put('/users/{id}', [UserController::class, 'updateUser']);
        Route::delete('/users/{id}', [UserController::class, 'deleteUser']);


    });

    // Rrotat për shikimin e të dhënave
    
});

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::get('/movies', [MovieController::class, 'index']);
    Route::get('/movies/{id}', [MovieController::class, 'show']);
    
