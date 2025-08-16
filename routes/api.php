<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/astronauts", [MissionController::class, "getAstronauts"]);
Route::get("/destinations", [MissionController::class, "getDestinations"]);
Route::post("/missions", [MissionController::class, "executeMission"])
    -> middleware(ValidateToken::class);
