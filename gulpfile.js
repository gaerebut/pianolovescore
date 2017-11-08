var elixir = require('laravel-elixir');
//require('laravel-elixir-vue-2'); // recommended for vue 2

elixir.config.sourcemaps = false;

elixir(function(mix) {
	mix.scripts(['app.js'], 'public/js/app.js');
	mix.scripts(['bootstrap.min.js','app.js'], 'public/js/admin.js');
	mix.scripts(['admin/sanitize.js'], 'public/js/sanitize.js');
	mix.scripts(['admin/bootstrap-confirmation.min.js'], 'public/js/bootstrap-confirmation.min.js');
    mix.sass('app.scss');
});
