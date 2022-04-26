<x-midone-base>
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="{{ env('APP_URL') }}" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6"
                        src="{{ asset('midone/dist/images/logo.png') }}">
                    <span class="text-white text-lg ml-3"> {{ config('app.name', 'Laravel') }} </span>
                </a>
                <div class="my-auto">
                    <div class="-intro-x text-white font-medium leading-tight pl-16">
                        <svg class="h-60 w-60" fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 310 310"
                            style="enable-background:new 0 0 310 310;" xml:space="preserve">
                            <path d="M300.606,159.727l-45.333-45.333c-5.857-5.858-15.355-5.858-21.213,0L225,123.454V15c0-8.284-6.716-15-15-15H20
                                C11.716,0,5,6.716,5,15v240.002c0,8.284,6.716,15,15,15h85V295c0,8.284,6.716,15,15,15h45.333c3.979,0,7.794-1.581,10.607-4.394
                                l124.667-124.667C306.465,175.081,306.465,165.585,300.606,159.727z M35,30h160v123.454l-85.606,85.605
                                c-0.302,0.301-0.581,0.619-0.854,0.942H35V30z M159.12,280H135v-24.121l109.667-109.666l24.12,24.12L159.12,280z" />

                        </svg>
                    </div>
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A un par de clicks para
                        <br>
                        crear tu cuenta.
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Administra toda tu
                        información desde un solo lugar</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Registrarse
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A un par de
                        clicks
                        para crear tu cuenta. Administra toda tu información desde un solo lugar.</div>
                    <x-jet-validation-errors class="mt-4 mb-4" />
                    <form class="" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text"
                                class="@error('name') border-danger @enderror  intro-x login__input form-control py-3 px-4 block"
                                id="name" name="name" value="{{ old('name') }}" placeholder="Nombre"
                                autocomplete="name">

                            <input type="email"
                                class="@error('email') border-danger @enderror intro-x login__input form-control py-3 px-4 block mt-4"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Correo electrónico">

                            <input type="password"
                                class="@error('password') border-danger @enderror intro-x login__input form-control py-3 px-4 block mt-4"
                                id="password" name="password" autocomplete="new-password" placeholder="Contraseña">

                            <input type="password"
                                class="@error('password_confirmation') border-danger @enderror intro-x login__input form-control py-3 px-4 block mt-4"
                                id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                placeholder="Confirmar contraseña">

                            {{-- <div class="intro-x w-full grid grid-cols-12 gap-4 h-1 mt-3">
                                    <div class="col-span-3 h-full rounded bg-success"></div>
                                    <div class="col-span-3 h-full rounded bg-success"></div>
                                    <div class="col-span-3 h-full rounded bg-success"></div>
                                    <div class="col-span-3 h-full rounded bg-slate-100 dark:bg-darkmode-800"></div>
                                </div>
                                <a href="" class="intro-x text-slate-500 block mt-2 text-xs sm:text-sm">What is a secure password?</a> 
                                <input type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password Confirmation"> --}}
                        </div>
                        {{-- <div class="intro-x flex items-center text-slate-600 dark:text-slate-500 mt-4 text-xs sm:text-sm">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">I agree to the Envato</label>
                                <a class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>. 
                            </div> --}}
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit"
                                class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Registrarse</button>
                            <a href="{{ route('login') }}"
                                class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Ingresar</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
    <!-- BEGIN: Dark Mode Switcher-->
    <div data-url="{{ route('dark-mode-switcher2') }}"
        class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
        <div
            class="dark-mode-switcher__toggle {{ session('dark_mode') ? 'dark-mode-switcher__toggle--active' : '' }} border">
        </div>
    </div>
</x-midone-base>

{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
