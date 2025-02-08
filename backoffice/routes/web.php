<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Rutas que no requieren autenticación
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// O puedes definir las rutas manualmente:
Route::prefix('password')->group(function () {
    Route::get('reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
});
// Rutas de autenticación
Auth::routes(['verify' => true]);

// Rutas del perfil de usuario
// Route::prefix('profile')->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/users/{user}/toggle-active', [ProfileController::class, 'toggleActive'])->name('users.toggleActive');
// });

// Route::middleware(['auth'])->group(function () {
Route::resource('users', ProfileController::class);
Route::resource('articles', ArticleController::class)->except(['show', 'edit']);
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::delete('/articles/{id}/photo/{photo}', [ArticleController::class, 'deletePhoto'])->name('articles.delete_photo');
Route::resource('settings', SettingController::class);
Route::resource('characteristics', CharacteristicController::class);
Route::get('/api/regions', [LocationController::class, 'getRegions']);
Route::get('/api/regions/{regionId}/communes', [LocationController::class, 'getComunas']);
Route::resource('faqs', FaqController::class)->except(['show']);
Route::post('faqs/update-order', [FaqController::class, 'updateOrder'])->name('faqs.updateOrder');
Route::resource('faqs', controller: FaqController::class);
Route::resource('roles', RoleController::class);
Route::get('/home', [HomeController::class, 'index'])->name('home');
// });