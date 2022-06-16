<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('midone/dist/images/logo.png') }}" rel="shortcut icon">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    @stack('styles')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('midone/dist/css/app.css') }}" /> --}}

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="antialiased bg-gray-100 ">
    <x-jet-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    @stack('scripts')

    @livewireScripts

    <footer class="bg-gray-100">
        <div class="relative max-w-screen-xl px-4 py-8 mx-auto sm:px-6 lg:px-8 lg:pt-12">
            <div class="lg:flex lg:items-end lg:justify-between">
                <div>
                    <div class="flex justify-center text-teal-600 lg:justify-start">
                        <img src="{{ asset('midone/dist/images/logo.png') }}" alt="logo" class="max-w-full" />

                    </div>

                    <p class="max-w-md mx-auto mt-6 leading-relaxed text-center text-teal-600 lg:text-left">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt
                        consequuntur amet culpa cum itaque neque.
                    </p>
                </div>

                <nav class="mt-12 lg:mt-0" aria-labelledby="footer-navigation">
                    <h2 class="sr-only" id="footer-navigation">Footer navigation</h2>

                    <ul class="flex flex-wrap justify-center gap-6 lg:justify-end md:gap-8 lg:gap-12">
                        <li>
                            <a class="text-teal-600 transition hover:text-teal-600/75" href="/">
                                About
                            </a>
                        </li>

                        <li>
                            <a class="text-teal-600 transition hover:text-teal-600/75" href="/">
                                Services
                            </a>
                        </li>

                        <li>
                            <a class="text-teal-600 transition hover:text-teal-600/75" href="/">
                                Projects
                            </a>
                        </li>

                        <li>
                            <a class="text-teal-600 transition hover:text-teal-600/75" href="/">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <p class="mt-12 text-sm text-center text-gray-400 lg:text-right">
                Copyright &copy; 2022. All rights reserved.
            </p>
        </div>
    </footer>
</body>

</html>
