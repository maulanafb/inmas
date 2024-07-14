const mix = require('laravel-mix');

mix.browserSync({
    proxy: 'insmas.test', // Ganti dengan URL proyek kamu
    files: [
        'app/**/*',
        'resources/views/**/*',
        'routes/**/*',
        'public/**/*'
    ]
});

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
