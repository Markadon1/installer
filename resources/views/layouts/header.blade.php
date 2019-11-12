<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('js/jquery-3.4.0.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/jquery.color.js')}}"></script>
    <script src="{{url('https://kit.fontawesome.com/ab4de56d1d.js')}}"></script>
    <title>New-Installer</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib.css') }}" rel="stylesheet">

</head>
<body>
@if(Auth::guest())
<div class="header">
    <div class="header_name">New-Installer</div>

        <div style="margin-top: 10px">
            <a href="{{route('login')}}">Вход</a>
            <a href="{{route('register')}}">Регистрация</a>
        </div>
</div>
<hr>
@else
<div class="container-body">
<div class="content">
    @yield('content')
</div>
</div>
@endif
@yield('auth')
</body>
</html>
