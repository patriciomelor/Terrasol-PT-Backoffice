<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;

 Auth::routes();

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas personalizadas
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::resource('users', ProfileController::class);
Route::patch('users/{user}/toggle-active', [ProfileController::class, 'toggleActive'])->name('users.toggleActive');