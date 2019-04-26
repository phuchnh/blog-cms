<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function boot(\Illuminate\Http\Request $request)
    {
        // Set the app locale according to the UR
        if ($request->segment(1) !== 'api' ||
            $request->segment(1) !== 'admin') {
            app()->setLocale($request->segment(1));
        }

        Schema::defaultStringLength(191);
        Relation::morphMap([
            'post'     => 'App\Models\Post',
            'taxonomy' => 'App\Models\Taxonomy',
            'client'   => 'App\Models\Client',
            'user'     => 'App\Models\User',
        ]);
    }
}
