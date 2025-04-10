<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PropertyController;
use App\Http\Controllers\PropertyController as AdminPropertyController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SEARCH
Route::get('/buscar', [SearchController::class, 'index'])->name('search');

// PROPERTIES
Route::get('/propiedad/{slug}', [PropertyController::class, 'show'])->name('guest.property.show');
Route::get('/propiedades', [PropertyController::class, 'index'])->name('guest.properties.index');

// ABOUT
Route::get('/nosotros', fn() => view('about.index'))->name('about');

// ENVIROMENT
Route::get('/entorno', [EnvironmentController::class, 'index'])->name('environment');
Route::get('/entorno/{slug}', fn($slug) => view('environment.show', ['slug' => $slug]))->name('location.show');

// CONTACT
Route::get('/contact', fn() => view('contact.index'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Propiedades
    Route::resource('admin/properties', AdminPropertyController::class);

    // Gestión de usuarios
    Route::resource('admin/users', UserController::class);

    // Informes
    Route::get('admin/reports', [ReportController::class, 'index'])->name('admin.reports');

    // Configuración
    Route::get('admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
});


require __DIR__ . '/auth.php';
