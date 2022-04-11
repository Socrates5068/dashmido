<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ session()->has('color_scheme') ? session('color_scheme') : 'default' }}
    {{ session('dark_mode') ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @stack('styles')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ asset('midone/dist/images/logo.svg') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ asset('midone/dist/css/app.css') }}" />
    <!-- BEGIN: Midone styles-->

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('midone/dist/js/app.js') }}" defer></script>
    <!-- BEGIN: Midone JS Assets-->
    {{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"
        defer>
    </script> --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places" defer></script> --}}
    <!-- END: JS Assets-->
</head>

<body class="font-sans antialiased">

    <x-admin.mobile-menu />

    <x-admin.side-menu>
        {{ $slot }}
    </x-admin.side-menu>

    <div class="hidden md:block">
        <x-color-palette />
    </div>
    
    @stack('modals')

    @livewireScripts

    @stack('scripts')
</body>

</html>
