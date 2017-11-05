@extends('layouts.admin')

@section('main')
<div class="container">
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
    <div class="row">
        <div class="col-md-offset-4 col-md-6 ">
            <h3>Connexion</h3>
            <p>Merci de vous connecter ci-dessous pour acceder au contenu souhaité.</p>
        </div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route( 'admin_login_connect' )  }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label for="username" class="col-md-4 control-label">Login</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </div>
    </form>
</div>
@endsection