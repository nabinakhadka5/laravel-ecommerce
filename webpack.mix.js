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
    .autoload({
        jquery:['$','jQuery','window.jquery','jquery'],
        "popper.js" : ["Popper"]
    })
    .extract()
    .js('resources/js/admin.js','public/js')
    .sass('resources/sass/admin.scss','public/css')
    .copyDirectory('resources/template/home/images/icons','public/images')
    .sass('resources/sass/app.scss', 'public/css');
