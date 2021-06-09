<?php

namespace App\Providers;

use App\Models\Categoria;
use Illuminate\Support\ServiceProvider;
// use Illuminate\Support\Facades\View;

class CategoriaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $categorias = Categoria::all();
            $view->with('categorias', $categorias);
        });
    }
}
