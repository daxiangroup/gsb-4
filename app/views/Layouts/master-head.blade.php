<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Group Study Buddy</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/style.css') }}
    {{ HTML::style('css/fonts.css') }}
    {{ HTML::style('css/gsb.css') }}

    @yield('page-specific-css-header')
    @yield('page-specific-js-header')
</head>
<body class="@yield('page-specific-classes')">
    <div role="page-header">
        <div class="inner">
            <div class="logo">GSB<span>Group Study Buddy Y'all...</span></div>

            <div role="navigation">
            @include('Layouts.navigation')
            </div>
        </div>
    </div>

    <div class="wrapper">


        <div role="main" class="main">