<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <header class="container-fluid">
            <div class="row text-center">
                <h1 class="text-center logo">PianoLoveScore</h1>
            </div>
            <div class="row">
                <form action="{{ route('search', ['q'=>'']) }}" method="get">
                    <div class="col-sm-offset-3 col-sm-4">
                        <input type="text" class="form-control" placeholder="Rechercher une partition, un compositeur..." name="q" pattern=".{2,20}" required/>
                    </div>
                    <div class="col-sm-2">
                       <input type="submit" class="form-control" value="Rechercher" /> 
                    </div>
                </form>
            </div>
            <div class="row">
                @include('includes.nav_public')
            </div>
        </header>
        <main class="container">
            @yield('breadcrumb')
            <article>
                @yield('main')
            </article>
        </main>
        <footer class="container-fluid text-center">

        </footer>
        @section('js_code')
        @show
    </body>
</html>
