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

// 🔒 Redirecciones para login/register según idioma actual
Route::redirect('/backoffice', '/' . app()->getLocale() . '/backoffice');
Route::redirect('/register', '/' . app()->getLocale() . '/register');

// 🛠 Página en construcción o acceso por puerta trasera
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

// 🌍 Rutas públicas con idioma (ES/EN/FR/DE)
Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function () {
    // Auth
    require __DIR__ . '/auth.php';

    // Home
    Route::get('/', [HomeController::class, 'index']);

    // Propiedades
    Route::get('/propiedad/{slug}', [PropertyController::class, 'show'])->name('guest.property.show');
    Route::get('/propiedades', [PropertyController::class, 'index'])->name('guest.properties.index');
    Route::get('/favoritos', [PropertyController::class, 'favoritos'])->name('guest.properties.favorites');
    Route::post('/toggle-favorite', [FavoriteController::class, 'toggle'])->name('favorites.toggle');

    // Buscar
    Route::get('/buscar', [SearchController::class, 'index'])->name('search');

    // Sobre nosotros / contacto
    Route::get('/nosotros', fn() => view('about.index'))->name('about');
    Route::get('/contact', fn() => view('contact.index'))->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    // Entorno y zonas
    Route::get('/entorno', [EnvironmentController::class, 'index'])->name('environment');
    Route::get('/entorno/{slug}', [EnvironmentController::class, 'show'])->name('zonas.show');
})->where(['locale' => 'es|en|fr|de']);

// 🔐 Rutas de administrador
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('properties', AdminPropertyController::class);
    Route::patch('properties/{property}/images/{image}/set-thumbnail', [PropertyImageController::class, 'setThumbnail'])->name('properties.images.set-thumbnail');
    Route::delete('properties/images/{id}', [PropertyImageController::class, 'destroy'])->name('properties.images.destroy');
    Route::resource('zonas', ZonaController::class);
    Route::resource('users', UserController::class);
    Route::get('reports', [ReportController::class, 'index'])->name('reports');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
});

// 👤 Perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🧪 Ruta de prueba para slugs
Route::get('/test-slug/{slug}', function ($slug) {
    return App\Models\Property::where('slug', $slug)->firstOrFail();
});

// 🚫 Fallback 404 para slugs inexistentes
Route::fallback(function () {
    abort(404);
});
