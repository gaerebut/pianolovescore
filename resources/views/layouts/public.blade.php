<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <header class="container-fluid">
            <div class="row">
                <h1 class="text-center">PianoLoveScore</h1>
            </div>
            <div class="row">
                <form action="#">
                    <div class="col-sm-offset-3 col-sm-4">
                        <input type="text" class="form-control" placeholder="Rechercher une partition, un compositeur..." />
                    </div>
                    <div class="col-sm-2">
                       <input type="submit" class="form-control" value="Rechercher" /> 
                    </div>
                </form>
            </div>
            <div class="row">
                @include('includes.nav')
            </div>
        </header>
        <main class="container">
            @yield('breadcrumb')
            <article>
                @yield('main')
            </article>
        </main>
        <footer class="container-fluid text-center">FOOTER</footer>
        @section('js_code')
        @show
    </body>
</html>
