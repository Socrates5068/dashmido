{{-- <x-midone-base>
    <div class="container sm:px-10">
        <div class="block grid-cols-2 gap-4 xl:grid">
            <!-- BEGIN: Login Info -->
            <div class="flex-col hidden min-h-screen xl:flex">
                <a href="{{ env('APP_URL') }}" class="flex items-center pt-5 -intro-x">
                    <img alt="Midone - HTML Admin Template" class="w-6"
                        src="{{ asset('midone/dist/images/logo.png') }}">
                    <span class="ml-3 text-lg text-white"> {{ config('app.name', 'Laravel') }} </span>
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="w-1/2 -mt-16 -intro-x"
                        src="{{ asset('midone/dist/images/illustration.svg') }}">
                    <div class="mt-10 text-4xl font-medium leading-tight text-white -intro-x">
                        A un par de clicks para
                        <br>
                        ingresar a su cuenta
                    </div>
                    <div class="mt-5 text-lg text-white -intro-x text-opacity-70 dark:text-slate-400">Administre toda su
                        información desde un solo lugar</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="flex h-screen py-5 my-10 xl:h-auto xl:py-0 xl:my-0">
                <div
                    class="w-full px-5 py-8 mx-auto my-auto bg-white rounded-md shadow-md xl:ml-20 dark:bg-darkmode-600 xl:bg-transparent sm:px-8 xl:p-0 xl:shadow-none sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="text-2xl font-bold text-center intro-x xl:text-3xl xl:text-left">
                        Ingresar
                    </h2>
                    <div class="mt-2 text-center intro-x text-slate-400 xl:hidden">A un par de clicks
                        para crear su cuenta. Administre toda su información desde un solo lugar.</div>

                    <x-jet-validation-errors class="mt-4 mb-4" />

                    @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mt-8 intro-x">
                            <input class="@error('username') border-danger @enderror intro-x login__input form-control py-3 px-4 block" id="email" type="text"
                                name="username" value="{{ old('username') }}" placeholder="Nombre de usuario">

                            <input type="password" class="@error('password') border-danger @enderror intro-x login__input form-control py-3 px-4 block mt-4"
                                id="password" name="password" autocomplete="current-password" placeholder="Contraseña">
                        </div>

                        <div class="flex mt-4 text-xs intro-x text-slate-600 dark:text-slate-500 sm:text-sm">
                            <div class="flex items-center mr-auto">
                                <input name="remember" id="remember" type="checkbox"
                                    class="mr-2 border form-check-input">
                                <label class="cursor-pointer select-none" for="remember">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-sm text-gray-600 underline hover:text-gray-900"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="mt-5 text-center intro-x xl:mt-8 xl:text-left">
                            <button class="w-full px-4 py-3 align-top btn btn-primary xl:w-32 xl:mr-3">Ingresar</button>
                            <a href="{{ route('register') }}" class="w-full px-4 py-3 mt-3 align-top btn btn-outline-secondary xl:w-32 xl:mt-0">Registrarse</a>
                            
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: Dark Mode Switcher-->
    <div data-url="{{ route('dark-mode-switcher2') }}"
        class="fixed bottom-0 right-0 z-50 flex items-center justify-center w-40 h-12 mb-10 mr-10 border rounded-full shadow-md cursor-pointer dark-mode-switcher box">
        <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
        <div
            class="dark-mode-switcher__toggle {{ session('dark_mode') ? 'dark-mode-switcher__toggle--active' : '' }} border">
        </div>
    </div>
    <!-- END: Dark Mode Switcher-->
</x-midone-base> --}}

<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
            <img alt="Midone - HTML Admin Template" class="w-30"
                        src="{{ asset('midone/dist/images/logo.png') }}">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="username" value="Nombre de usuario" />
                <x-jet-input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
