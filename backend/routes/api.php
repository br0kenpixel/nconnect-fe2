<?php

use App\Http\Controllers\SpeakerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("/speakers")->group(function () {
    Route::get("/", [SpeakerController::class, 'all']);

    Route::middleware("auth:sanctum")->group(function () {
        // TODO: ...
    });
});