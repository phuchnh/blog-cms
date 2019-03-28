const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/**
 * For user site
 */
mix.js('resources/js/app.js', 'public/js');
mix.sass('resources/sass/app.scss', 'public/css');

/**
 * For admin site
 */
mix.copy('node_modules/admin-lte/dist/img', 'public/assets/img');
mix.js('resources/assets/js/app.js', 'public/assets/js');
mix.sass('resources/assets/sass/app.scss', 'public/assets/css');
