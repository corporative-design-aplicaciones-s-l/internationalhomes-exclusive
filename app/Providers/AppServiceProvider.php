<?php

namespace App\Providers;

use App\Models\Zona;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        App::setLocale(Session::get('locale', config('app.locale')));

        View::composer('layouts.*', function ($view) {
            $zonas = Zona::orderBy('nombre')->get();
            $view->with('zonas', $zonas);
        });

    }
}
