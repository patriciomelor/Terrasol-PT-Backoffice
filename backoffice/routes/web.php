<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController; // Importar el controlador

// Rutas de autenticación
Auth::routes(['verify' => true]);

// Home
Route::get('/home', [HomeController::class, 'home'])->name('home');

// Página de inicio
Route::get('/', function () {
    return view('auth.login');
});

// O puedes definir las rutas manualmente:
Route::prefix('password')->group(function () {
    Route::get('reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('/password/reset', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');
});


// Rutas de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Rutas del perfil de usuario
Route::prefix('profile')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/users/{user}/toggle-active', [ProfileController::class, 'toggleActive'])->name('users.toggleActive');
});
Route::resource('users', ProfileController::class);

// Rutas para artículos
Route::resource('articles', ArticleController::class)->except(['show', 'edit']);
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::delete('/articles/{id}/photo/{photo}', [ArticleController::class, 'deletePhoto'])->name('articles.delete_photo');

// Rutas para roles
Route::resource('roles', RoleController::class);

// Rutas para configuraciones del sitio
Route::resource('settings', SettingController::class);

// Rutas para características
Route::resource('characteristics', CharacteristicController::class);

use App\Http\Controllers\LocationController;

Route::get('/api/regions', [LocationController::class, 'getRegions']);
Route::get('/api/regions/{regionId}/communes', [LocationController::class, 'getComunas']);
use App\Http\Controllers\FaqController;

Route::resource('faqs', FaqController::class)->except(['show']);
Route::post('faqs/update-order', [FaqController::class, 'updateOrder'])->name('faqs.updateOrder');
Route::resource('faqs', FaqController::class);