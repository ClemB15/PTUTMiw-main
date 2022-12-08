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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/homeMain.js', 'public/js')
    .js('resources/js/icon-provider.js', 'public/js')
    .js('resources/js/testAPIGouv.js', 'public/js')
    .js('resources/js/function_map_and_filter.js', 'public/js')
    .sass('resources/styles/nav.scss', 'public/css')
    .sass('resources/styles/home.scss', 'public/css')
    .sass('resources/styles/reset.scss', 'public/css')
    .sass('resources/styles/login.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css');
