<div>
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
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16"
                        src="{{ asset('midone/dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        A un par de clicks para
                        <br>
                        ingresar a su cuenta
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Administre toda su
                        información desde un solo lugar</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div
                    class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Registrarse
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A un par de
                        clicks para
                        <br>
                        crear su cuenta
                    </div>
                    <x-jet-validation-errors class="mt-4 mb-4" />
                    <form class="" method="POST" action="/register">
                        @csrf
                        <div class="intro-x mt-8">
                            <input name="name" type="text"
                                class="intro-x login__input form-control py-3 px-4 block" placeholder="Nombres">
                            <input name="f_last_name" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Apellido paterno">
                            <input name="m_last_name" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Apellido Materno">
                            <input name="ci" type="number" class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="C.I.">
                            <input name="email" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Email">
                            <input name="password" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4"
                                placeholder="Password">
                            <input name="password_confirmation" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4"
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
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
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
    <!-- END: Dark Mode Switcher-->
</div>
