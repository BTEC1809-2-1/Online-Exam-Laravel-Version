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

mix
    //javascript
    .js('resources/js/app.js', 'public/js')
    .js('resources/js/ajaxSearch.js','public/js')
    .js('resources/js/sidebarDecorations.js', 'public/js')
    //css
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/question.scss', 'public/css')

