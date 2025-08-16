<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Middleware\ValidateToken;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/astronauts", [MissionController::class, "getAstronauts"]);
Route::get("/destinations", [MissionController::class, "getDestinations"]);
Route::post("/missions", [MissionController::class, "executeMission"])
    -> middleware(ValidateToken::class);
