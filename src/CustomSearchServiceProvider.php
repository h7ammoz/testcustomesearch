<?php

// MyVendor\search\src\CustomSearchServiceProvider.php

namespace MyVendor\Search;

use Illuminate\Support\ServiceProvider;

class CustomSearchServiceProvider extends ServiceProvider {

    public function boot() {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'search');
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        $this->publishes([
            __DIR__ . '/config/sp_mawdoo3_laravel.php' => config_path('sp_mawdoo3_laravel.php'),
        ]);
    }

    public function register() {
        
    }

}
