<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <header class="container-fluid">
            <div class="row">
                <h1 class="text-center">@section('admin_title')PianoLoveScore @show</h1>
                <div class="container">
                @if(Auth::check())
                    <div class="pull-right">
                        <a href="{{ route('admin_logout') }}">Se déconnecter</a>
                    </div>
                @endif
                </div>
            </div>
            <div class="row">
                @include('includes.nav_admin')
            </div>
        </header>
        <main class="container">
            @yield('breadcrumb')
            <article>
                @php
                    $session_info = session('info');
                    $session_success = session('success');
                    $session_error = session('error');
                @endphp
                
                @if ( !is_null( $session_info ) )
                    @foreach ( $session_info as $session )
                        <div class="alert alert-info" role="alert">
                            <span class="glyphicon glyphicon-info-sign"></span>
                            {{ $session }}
                        </div>
                    @endforeach
                @endif
                @if ( !is_null( $session_success ) )
                    @foreach ( $session_success as $session )
                        <div class="alert alert-success" role="alert">
                            <span class="glyphicon glyphicon-ok-sign"></span>
                            {{ $session }}
                        </div>
                    @endforeach
                @endif
                @if ( !is_null( $session_error ) )
                    @foreach ( $session_error as $session )
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-remove-sign"></span>
                            {{ $session }}
                        </div>
                    @endforeach
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('main')
            </article>
        </main>
        <footer class="container-fluid text-center">FOOTER</footer>
        @section('js_code')
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
            <script src="{{ elixir( '/js/admin.js' ) }}"></script>
        @show
    </body>
</html>
