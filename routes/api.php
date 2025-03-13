<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RewardController;
use App\Http\Controllers\API\GoalController;
use App\Http\Controllers\API\TaskController;

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
});
