<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <header class="container-fluid">
            <div class="row">
                <h1 class="text-center">@section('admin_title')PianoLoveScore @show</h1>
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
