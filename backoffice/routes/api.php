<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\LocationController;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/articles', [ArticleController::class, 'apiIndex']);
    Route::get('/settings', [SettingController::class, 'apiSettings']);
    Route::get('/api/regions', [LocationController::class, 'getRegions']);
    Route::get('/api/regions/{region}/communes', [LocationController::class, 'getCommunes']);
});



