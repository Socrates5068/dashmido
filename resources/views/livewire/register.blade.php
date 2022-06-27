<div>
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
            <!-- BEGIN: Register Form -->
            <div class="flex h-screen py-5 my-10 xl:h-auto xl:py-0 xl:my-0">
                <div
                    class="w-full px-5 py-8 mx-auto my-auto bg-white rounded-md shadow-md xl:ml-20 dark:bg-darkmode-600 xl:bg-transparent sm:px-8 xl:p-0 xl:shadow-none sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="text-2xl font-bold text-center intro-x xl:text-3xl xl:text-left">
                        Registrarse
                    </h2>
                    <div class="mt-2 text-center intro-x text-slate-400 dark:text-slate-400 xl:hidden">A un par de
                        clicks para
                        <br>
                        crear su cuenta
                    </div>
                    <x-jet-validation-errors class="mt-4 mb-4" />
                    <form class="" method="POST" action="/register">
                        @csrf
                        <div class="mt-8 intro-x">
                            <input name="name" type="text"
                                class="block px-4 py-3 intro-x login__input form-control" placeholder="Nombres">
                            <input name="f_last_name" type="text" class="block px-4 py-3 mt-4 intro-x login__input form-control"
                                placeholder="Apellido paterno">
                            <input name="m_last_name" type="text" class="block px-4 py-3 mt-4 intro-x login__input form-control"
                                placeholder="Apellido Materno">
                            <input name="ci" type="number" class="block px-4 py-3 mt-4 intro-x login__input form-control"
                                placeholder="C.I.">
                            <input name="email" type="text" class="block px-4 py-3 mt-4 intro-x login__input form-control"
                                placeholder="Email">
                            <input name="password" type="password" class="block px-4 py-3 mt-4 intro-x login__input form-control"
                                placeholder="Password">
                            <input name="password_confirmation" type="password" class="block px-4 py-3 mt-4 intro-x login__input form-control"
                                placeholder="Confirmar password">
                            <div class="mt-3">
                                <label for="sex" class="form-label">Sexo</label>
                                <select name="sex" data-placeholder="Seleccione un sexo"
                                    class="w-full form-control">
                                    <option value="">Seleccione un sexo</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 text-center intro-x xl:mt-8 xl:text-left">
                            <button class="w-full px-4 py-3 align-top btn btn-primary xl:w-32 xl:mr-3">Register</button>
                            <a href="{{ route('login') }}"
                                class="w-full px-4 py-3 mt-3 align-top btn btn-outline-secondary xl:w-32 xl:mt-0">Ingresar</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END: Register Form -->
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
</div>
