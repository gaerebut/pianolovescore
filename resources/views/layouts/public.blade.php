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
        <footer class="container text-center">
            ©2017 - pianolovescore.com - <a href="https://www.facebook.com/groups/partitio.gratuite/" target="_blank">Notre Groupe Facebook</a>
        </footer>
        @section('js_code')
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-16559180-13"></script>
            <script>
              window.dataLayer = window.dataLayer || [];
              function gtag(){dataLayer.push(arguments);}
              gtag('js', new Date());
              gtag('config', 'UA-16559180-13');
            </script>

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
        @show
    </body>
</html>
