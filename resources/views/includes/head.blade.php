<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
@section('css')
<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
<link rel="icon" type="image/png" href="img/favicon.png" />
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
@show

@section('js')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
@show