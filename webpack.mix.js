const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/card/dist/card.css',
    'resources/css/app.css',
],  'public/css/app.css')

.css('node_modules/font-awesome/css/font-awesome.css', 'public/css/font-awesome.css')

.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/card/dist/card.js',
    'resources/js/checkout.js',
],  'public/js/app.js');
