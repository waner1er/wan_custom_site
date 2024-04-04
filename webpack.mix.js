let mix = require('laravel-mix');


mix.sass('assets/sass/main.scss', 'assets/css/main.css');
mix.browserSync({
    proxy: 'localhost:8000',
    files: [
        'assets/css/main.css',
        '**/*.php',  // Cela surveillera tous les fichiers .php dans votre projet
    ],
});