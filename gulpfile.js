var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.copy('resources/assets/bower/font-awesome/fonts', 'public/fonts');
    mix.copy('resources/assets/bower/metisMenu/dist/metisMenu.css', 'public/css');
    mix.less([
        'app.less'
        ]);
    	
    mix.scripts([
        // Foundation (direct link to jQuery in foot)
        '../bower/jquery/dist/jquery.js',
        '../bower/bootstrap/dist/js/bootstrap.js',
        '../bower/metisMenu/src/metisMenu.js',
        '../bower/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js',
        'vendor/fastclick.js',
        // jQuery UI
        'jquery-ui.js',
    	]);

    mix.version([
        'public/css/app.css',
        'public/js/all.js'
        ]);

   	
});
