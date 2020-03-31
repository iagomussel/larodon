const mix = require('laravel-mix');


mix.sass('resources/sass/app.scss','public/assets/css')

.js('resources/assets/js/app.js' , 'public/assets/js');