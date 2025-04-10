<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PropertyController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\ProfileController;
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
Route::get('/propiedad/{slug}', [PropertyController::class, 'show'])->name('property.show');
Route::get('/propiedades', [PropertyController::class, 'index'])->name('properties.index');

// ABOUT
Route::get('/nosotros', fn() => view('about.index'))->name('about');

// ENVIROMENT
Route::get('/entorno', [EnvironmentController::class, 'index'])->name('environment');
Route::get('/entorno/{slug}', fn($slug) => view('environment.show', ['slug' => $slug]))->name('location.show');

// CONTACT
Route::get('/contact', fn() => view('contact.index'))->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


require __DIR__.'/auth.php';
