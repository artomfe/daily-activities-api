<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RewardController;
use App\Http\Controllers\API\GoalController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\LevelController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Rotas para Rewards
    Route::apiResource('rewards', RewardController::class);
    Route::get('/select-rewards', [RewardController::class, 'listForSelect']);

     // Rotas para Goals
     Route::apiResource('goals', GoalController::class);

     // Rotas para Tasks
     Route::apiResource('tasks', TaskController::class);

      // Rotas para Items
    Route::apiResource('items', ItemController::class);

    // Rotas para Categories
    Route::apiResource('categories', CategoryController::class);
    Route::get('/select-categories', [CategoryController::class, 'listForSelect']);

    // Rotas para Levels
    Route::apiResource('levels', LevelController::class);
});
