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
     * @param \App\Providers\Illuminate\Http\Request $request
     * @return void
     */
    public function boot(\Illuminate\Http\Request $request)
    {
        // Set the app locale according to the URL
        app()->setLocale($request->segment(1));

        Schema::defaultStringLength(191);
        Relation::morphMap([
            'posts' => 'App\Models\PostTranslation',
            'taxonomies' => 'App\Models\TaxonomyTranslation',
        ]);
    }
}
