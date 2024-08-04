<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\AgentController;
use App\http\Controllers\ClientController;
use App\http\Controllers\EquipementController;
use App\http\Controllers\ProprieteController;
use App\http\Controllers\ProprietesequipementsController;
use App\http\Controllers\LocationController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('agents', AgentController :: class);
Route::apiResource('clients', ClientController :: class);
Route::apiResource('equipements', EquipementController :: class);
Route::apiResource('proprietes', ProprieteController :: class);
Route::apiResource('proprietesequipements', ProprietesequipementsController :: class);
Route::apiResource('locations', LocationController :: class);
