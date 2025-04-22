<?php

use App\Http\Controllers\Admin\PropertyImageController;
use App\Http\Controllers\Admin\ZonaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PropertyController;
use App\Http\Controllers\PropertyController as AdminPropertyController;
use App\Http\Controllers\Front\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Models\Property;
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

Route::get('/', function () {
    if (env('APP_UNDER_CONSTRUCTION', false)) {
        return view('under-construction');
    }

    return redirect()->route('welcome.access');
});

Route::get('/puerta-trasera', function () {
    $featured = Property::where('is_featured', true)->get();

    return view('welcome', compact('featured'));
})->name('welcome.access');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function () {
    //HOME
    Route::get('/', action: [HomeController::class, 'index']);


    // SEARCH
    Route::get('/buscar', [SearchController::class, 'index'])->name('search');

    // PROPERTIES
    Route::get('/propiedad/{slug}', [PropertyController::class, 'show'])->name('guest.property.show');
    Route::get('/propiedades', [PropertyController::class, 'index'])->name('guest.properties.index');
    Route::get('/favoritos', [PropertyController::class, 'favoritos'])->name('guest.properties.favorites');
    Route::post('/toggle-favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');


    // ABOUT
    Route::get('/nosotros', fn() => view('about.index'))->name('about');

    // ENVIROMENT
    Route::get('/entorno', [EnvironmentController::class, 'index'])->name('environment');
    Route::get('/entorno/{slug}', [EnvironmentController::class, 'show'])->name('zonas.show');

    // CONTACT
    Route::get('/contact', fn() => view('contact.index'))->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

// ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Propiedades
    Route::resource('properties', AdminPropertyController::class);
    Route::patch('properties/{property}/images/{image}/set-thumbnail', [PropertyImageController::class, 'setThumbnail'])
        ->name('properties.images.set-thumbnail');

    Route::delete('properties/images/{id}', [PropertyImageController::class, 'destroy'])
        ->name('properties.images.destroy');

    //ZONAS
    Route::resource('zonas', ZonaController::class)->names('zonas');



    // Gestión de usuarios
    Route::resource('users', UserController::class);

    // Informes
    Route::get('reports', [ReportController::class, 'index'])->name('reports');

    // Configuración
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
});

Route::get('/test-slug/{slug}', function ($slug) {
    return App\Models\Property::where('slug', $slug)->firstOrFail();
});

require __DIR__ . '/auth.php';
