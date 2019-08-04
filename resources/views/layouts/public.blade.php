<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <header class="container-fluid">
            <div class="row text-center">
                <h1 class="text-center logo"><a href="{{ route(__('routes.home')) }}" title="@lang('messages.home.subtitle')">PianoLoveScore</a></h1>
                <span class="menu-hamburger glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>
            </div>
            <div class="row">
                <form action="{{ route(__('routes.search'), ['q'=>'']) }}" method="get" class="col-md-6 col-md-offset-3">
                    <div class="input-group stylish-input-group">
                        <input type="text" class="form-control" placeholder="@lang('messages.header_search_composer')" name="q" pattern=".{2,20}" required />
                        <span class="input-group-addon">
                            <button type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>  
                        </span>
                    </div>
                </form>
            </div>
            <div class="row">@include('includes.nav_public')</div>
        </header>
        <main class="container">
            @yield('breadcrumb')
            <article>@yield('main')</article>
        </main>
        <footer class="container text-center">
            ©2018 - pianolovescore.com - <a href="https://www.facebook.com/partitions.gratuites.piano" target="_blank">@lang('messages.footer_our_facebook_page')</a> - <a href="{{ route(__('routes.legals')) }}">@lang('nav.legals')</a> - <a href="{{ route('contact_us') }}">@lang('nav.contact_us')</a>
        </footer>
        @section('js_code')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <script>
                var menu_hamburger = document.querySelector('.menu-hamburger');
                var navbar = document.querySelector('.navbar');
                menu_hamburger.addEventListener('click', function(){
                    navbar.style.display = (navbar.style.display == 'block') ? 'none': 'block';
                });
            </script>
        @show
    </body>
</html>
