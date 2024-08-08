<?php
/*
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\AgentController;
use App\http\Controllers\ClientController;
use App\http\Controllers\EquipementController;
use App\http\Controllers\ProprieteController;
use App\http\Controllers\ProprietesequipementsController;
use App\http\Controllers\LocationController;


use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


Route::apiResource('agents', AgentController :: class);
Route::apiResource('clients', ClientController :: class);
Route::apiResource('equipements', EquipementController :: class);
Route::apiResource('proprietes', ProprieteController :: class);
Route::apiResource('proprietesequipements', ProprietesequipementsController :: class);
Route::apiResource('locations', LocationController :: class);
*/


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\ProprieteController;
use App\Http\Controllers\ProprietesequipementsController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');

// API Resources with Sanctum Middleware Protection
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('agents', AgentController::class);
    Route::apiResource('clients', ClientController::class);
    Route::apiResource('equipements', EquipementController::class);
    Route::apiResource('proprietes', ProprieteController::class);
    Route::apiResource('proprietesequipements', ProprietesequipementsController::class);
    Route::apiResource('locations', LocationController::class);
});
