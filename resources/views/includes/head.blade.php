<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">

<meta property="og:url" 		content="{{ Request::url() }}" />
<meta property="og:type" 		content="@yield('og_type')" />
<meta property="og:title" 		content="@yield('og_title')" />
<meta property="og:description"	content="@yield('og_description')" />
<meta property="og:image"		content="@yield('og_image')" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-16559180-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-16559180-13');
</script>

@section('css')
<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
<link rel="icon" type="image/png" href="img/favicon.png" />
<!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" /><![endif]-->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
@show