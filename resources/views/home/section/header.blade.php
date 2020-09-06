<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf_token" content="{{ csrf_token() }}">

    @yield('meta')

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png')}}"/>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('styles')
</head>
<body class="animsition">