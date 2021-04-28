<!DOCTYPE html>
@php
  session_start();
  session_destroy();
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    <link type="text/css" rel="stylesheet" href="{{ asset('css/material_icons.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/outer.css') }}"  media="screen,projection"/>
    <script type="text/javascript" src="{{ asset('js/scrollreveal.min.js') }}"></script>
</head>
<body>
    <div id="app" class=" green lighten-5">
            @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/mp.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}" defer></script>
    @yield('javascript')
</body>
</html>
