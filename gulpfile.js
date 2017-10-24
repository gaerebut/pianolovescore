var elixir = require('laravel-elixir');
//require('laravel-elixir-vue-2'); // recommended for vue 2

elixir.config.sourcemaps = false;

elixir(function(mix) {
	mix.scripts(['app.js'])
    mix.sass('app.scss');
});