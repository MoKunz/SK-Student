<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{config('app.name','App')}} </title>
    <meta name="description" content="SK Student Space">
    <meta name="author" content="SK Student Committee">

    <link rel="stylesheet" href="/css/vue-material.css">
    <link rel="stylesheet" href="/css/webapp.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="@yield('body-class')">
@yield('body')
<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/webapp.js"></script>
</body>
</html>