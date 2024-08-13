<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas pass
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
//rutas personalizadas
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::resource('users', ProfileController::class);
Route::patch('users/{user}/toggle-active', [ProfileController::class, 'toggleActive'])->name('users.toggleActive');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/check-roles', function () {
    $roles = \App\Models\Role::all();
    dd($roles);
});
