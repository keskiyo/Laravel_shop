<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('routeactive', function($route){
            return "<?php if (Request::route()->named($route)) { echo'class=\"header_nav_link active\"'; } ?>";
        });

        Blade::if('admin', function(){
            return Auth::check() && Auth::user()->isAdmin(); 
        });    

        Product::observe(ProductObserver::class);
    }
}
