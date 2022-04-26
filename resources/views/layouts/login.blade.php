<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ session()->has('color_scheme') ? session('color_scheme') : 'default' }}
    {{ session('dark_mode') ? 'dark' : '' }}">
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: 4ec3fc73-2ae0-4e9d-a434-0365fa16e3d0
-->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('midone/dist/images/logo.png') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registro {{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('midone/dist/css/app.css') }}" />

    <script src="{{ asset('midone/dist/js/app.js') }}" defer></script>

    @livewireStyles
</head>

<body class="login">

    {{ $slot }}

</body>

</html>
