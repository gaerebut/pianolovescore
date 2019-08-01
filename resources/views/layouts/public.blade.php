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
                <form action="{{ route(__('routes.search'), ['q'=>'']) }}" method="get">
                    <div class="col-sm-offset-3 col-sm-4">
                        <input type="text" class="form-control" placeholder="@lang('messages.header_search_composer')" name="q" pattern=".{2,20}" required/>
                    </div>
                    <div class="col-sm-2">
                       <input type="submit" class="form-control" value="@lang('messages.header_search')" /> 
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
            ©2018 - pianolovescore.com - <a href="https://www.facebook.com/groups/partitio.gratuite/" target="_blank">@lang('messages.footer_our_facebook_group')</a>
        </footer>
        @section('js_code')
            <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.25/jquery.fancybox.min.js"></script>
            <script src="/js/bootstrap.min.js" type="text/javascript"></script>
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        @show
    </body>
</html>
