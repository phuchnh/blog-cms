<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        // Using class based composers...
        view()->composer(
            ['*'],
            'App\Http\View\Composers\SettingComposer'
        );

        Blade::directive('ifIssetShowValue', function ($value) {
            if (@isset($value) && $value) {
                return "<?php echo $value?>";
            } else {
                return "<?php echo ''?>";
            }
        });

        /**
         * return Category string
         */
        Blade::directive('ifIssetShowCategoryTitle', function ($value) {
            if (@isset($value) && $value) {
                return "<?php echo implode(', ', array_column($value, 'title'))?>";
            } else {
                return "<?php echo ''?>";
            }
        });

        /**
         * Format Date
         */
        Blade::directive('formatDateCarbon', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('l, F d, Y') ?>";
        });

        /**
         * Format Time
         */
        Blade::directive('formatTimeCarbon', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('H:i A') ?>";
        });
    }
}
