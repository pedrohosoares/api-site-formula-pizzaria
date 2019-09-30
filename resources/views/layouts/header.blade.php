<!DOCTYPE html>
<html lang="en-US" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fórmula Pizzaria Delivery</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-pizzaro.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/red.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" media="all">
    <link rel="stylesheet" href="{{ asset('css/config.css') }}">
    <link rel="shortcut icon" href="https://transvelo.github.io/pizzaro-html/asset/images/fav-icon.png">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        let csrf_token = $('meta[name="csrf-token"]').attr('content');
    </script>
</head>

<body class="blog blog-grid right-sidebar" cz-shortcut-listen="true">