const {mix} = require('laravel-mix');

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

mix.js('resources/assets/js/webapp.js', 'public/js')
    .extract(['vue', 'vue-material','vue-router','lodash', 'axios'])
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/vue-material/dist/vue-material.css', 'public/css/vue-material.css')
    .sass('resources/assets/sass/webapp.scss', 'public/css')
    .webpackConfig(
        {
            resolve: {
                alias: {
                    'vue$': 'vue/dist/vue.common.js'
                }
            }
        }
    );
