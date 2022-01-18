<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Image;
use App\Models\Menu;
use Illuminate\Pagination\Paginator;

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
        //
        $image = new Image();
        View::share('placeholder', $image->placeholder);
        
        $navigation = Menu::where('position', config('menu.position.nav'))->first();
        View::share('navigation', $navigation);

        Paginator::useBootstrap();
    }
}
