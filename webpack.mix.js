const mixAdmin = require('laravel-mix');
//const mixWeb = require('laravel-mix');

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

mixAdmin
  .setPublicPath('public/static/admin')
  .setResourceRoot('/static/admin/')
  .webpackConfig({
    output: {
      publicPath: '/static/admin/',
    },
  });

mixAdmin
  .extract()
  .js('resources/js/admin/app.js', 'js').vue()
  .sass('resources/css/admin/app.scss', 'css')
  .sourceMaps();
