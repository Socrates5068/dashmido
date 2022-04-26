<x-midone-base>
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ env('APP_URL') }}" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6"
                        src="{{ asset('midone/dist/images/logo.png') }}">
                    <span class="text-white text-lg ml-3"> {{ config('app.name', 'Laravel') }} </span>
                </a>
                <div class="my-auto">
                    <div class="-intro-x text-white font-medium leading-tight pl-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-60 w-60" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-2">
                        A un solo clic de
                        <br>
                        recuperar su contraseña.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Recuperar sus
                        datos
                        de acceso es muy fácil</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Recuperar contraseña
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A un solo clic de recuperar su
                        contraseña.
                        Recuperar sus datos
                        de acceso es muy fácil</div>

                    <div class="mb-4 mt-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-jet-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="intro-x mt-8">
                            <input
                                class="@error('email') border-danger @enderror intro-x login__input form-control py-3 px-4 block"
                                id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="Correo electrónico">
                        </div>

                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button
                                class="btn btn-primary py-3 px-4 w-full xl:w-64 xl:mr-3 align-top">{{ __('Email Password Reset Link') }}</button>
                        </div>
                    </form>
                    <div data-url="{{ route('dark-mode-switcher2') }}"
                        class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
                        <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
                        <div
                            class="dark-mode-switcher__toggle {{ session('dark_mode') ? 'dark-mode-switcher__toggle--active' : '' }} border">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
</x-midone-base>

{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email"
                    :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
