<?php

use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\CustomPageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SpeakerController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("/speakers")->group(function () {
    Route::get("/", [SpeakerController::class, 'all']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [SpeakerController::class, 'create']);
        Route::post("/{id}", [SpeakerController::class, 'update']);
        Route::delete("/{id}", [SpeakerController::class, 'delete']);
    });
});

Route::prefix("/sponsors")->group(function () {
    Route::get("/", [SponsorController::class, 'all']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [SponsorController::class, 'create']);
        Route::post("/{id}", [SponsorController::class, 'update']);
        Route::delete("/{id}", [SponsorController::class, 'delete']);
    });
});

Route::prefix("/conferences")->group(function () {
    Route::get("/", [ConferenceController::class, 'all']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [ConferenceController::class, 'create']);
        Route::post("/{id}", [ConferenceController::class, 'update']);
        Route::delete("/{id}", [ConferenceController::class, 'delete']);
    });
});

Route::prefix("/stages")->group(function () {
    Route::get("/", [StageController::class, 'all']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [StageController::class, 'create']);
        Route::post("/{id}", [StageController::class, 'update']);
        Route::delete("/{id}", [StageController::class, 'delete']);
    });
});

Route::prefix("/schedule")->group(function () {
    Route::get("/", [ScheduleController::class, 'all']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [ScheduleController::class, 'create']);
        Route::post("/{id}", [ScheduleController::class, 'update']);
        Route::delete("/{id}", [ScheduleController::class, 'delete']);
    });
});

Route::prefix("/custom_pages")->group(function () {
    Route::get("/", [CustomPageController::class, 'all']);
    Route::get("/{id}", [CustomPageController::class, 'get']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [CustomPageController::class, 'create']);
        Route::post("/{id}", [CustomPageController::class, 'update']);
        Route::delete("/{id}", [CustomPageController::class, 'delete']);
    });
});

Route::prefix("/reviews")->group(function () {
    Route::get("/", [ReviewController::class, 'all']);
    Route::get("/{id}", [ReviewController::class, 'get']);

    Route::middleware("auth:sanctum")->group(function () {
        Route::put("/", [ReviewController::class, 'create']);
        Route::post("/{id}", [ReviewController::class, 'update']);
        Route::delete("/{id}", [ReviewController::class, 'delete']);
    });
});

Route::get("/stats", [StatsController::class, 'basic']);