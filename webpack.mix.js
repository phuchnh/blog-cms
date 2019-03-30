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
mix.js('resources/assets_frontend/js/app.js', 'public/app/js').autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
});
mix.sass('resources/assets_frontend/sass/app.scss', 'public/app/css');
mix.copy('resources/assets_frontend/sass/img', 'public/app/img');

/**
 * For admin site
 */
mix.copy('node_modules/admin-lte/dist/img', 'public/assets/img');
mix.js('resources/assets/js/app.js', 'public/assets/js');
mix.sass('resources/assets/sass/app.scss', 'public/assets/css');

mix.webpackConfig(() => {
    const config = {};

    config.resolve = {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            'vue$': 'vue/dist/vue.esm.js',
            '@': __dirname + '/resources/assets/js'
        }
    };
    return config;
});
