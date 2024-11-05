<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('v1')->group(function () {
    Route::get('recurso', [V1\FrontController::class, 'Post']);
});

Route::get('/api/settings', function () {
    return Setting::all();
});
use App\Http\Controllers\ArticleController;
Route::get('/articles', [ArticleController::class, 'apiIndex']);

use App\Http\Controllers\LocationController;
Route::get('/api/regions', [LocationController::class, 'getRegions']);
Route::get('/api/regions/{region}/communes', [LocationController::class, 'getCommunes']);
