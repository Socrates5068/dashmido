<div class="flex">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
        <a href="" class="intro-x flex items-center pl-5 pt-4">
            <img alt="Midone - HTML Admin Template" class="w-6"
                src="{{ asset('midone/dist/images/logo.png') }}">
            <span class="hidden xl:block text-white text-lg ml-3"> {{ config('app.name') }} </span>
        </a>
        <div class="side-nav__devider my-6"></div>
        <ul>
            @role('Administrador')
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ url()->current() == route('admin.dashboard') ? 'side-menu--active' : '' }} side-menu">
                        <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
            @endrole

            @role('Administrador')
                <li>
                    <a href="javascript:;"
                        class="{{ url()->current() == route('admin.users') || url()->current() == route('admin.positions') || url()->current() == route('admin.patients') ? 'side-menu--active' : '' }} side-menu">
                        <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="side-menu__title">
                            Personal
                            <div class="side-menu__sub-icon transform"> <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul
                        class="{{ url()->current() == route('admin.users') || url()->current() == route('admin.patients') ? 'side-menu__sub-open' : '' }} ">
                        <li>
                            <a href="{{ route('admin.users') }}"
                                class="{{ url()->current() == route('admin.users') ? 'side-menu--active' : '' }} side-menu">
                                <div class="side-menu__icon"> <i data-lucide="user-plus"></i> </div>
                                <div class="side-menu__title"> Usuarios </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.patients') }}"
                                class="{{ url()->current() == route('admin.patients') ? 'side-menu--active' : '' }} side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Pacientes </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endrole

            @role('Administrador')
                <li>
                    <a href="javascript:;"
                        class="{{ url()->current() == route('admin.schedule') || url()->current() == route('admin.table') ? 'side-menu--active' : '' }} side-menu">
                        <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                        <div class="side-menu__title">
                            Fichaje
                            <div class="side-menu__sub-icon transform"> <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </a>
                    <ul
                        class="{{url()->current() == route('admin.schedule') || url()->current() == route('admin.table') ? 'side-menu__sub-open' : '' }} ">
                        <li>
                            <a href="{{ route('admin.table') }}"
                                class="{{ url()->current() == route('admin.table') ? 'side-menu--active' : '' }} side-menu">
                                <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                                <div class="side-menu__title"> Tabla de horarios </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.schedule') }}"
                                class="{{ url()->current() == route('admin.schedule') ? 'side-menu--active' : '' }} side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Horarios para fichaje </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.patients') }}"
                                class="{{ url()->current() == route('admin.patients') ? 'side-menu--active' : '' }} side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Fichaje del día </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.patients') }}"
                                class="{{ url()->current() == route('admin.patients') ? 'side-menu--active' : '' }} side-menu">
                                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                <div class="side-menu__title"> Fichaje día mañana </div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endrole

            @role('Médico')
                <li>
                    <a href="{{ route('admin.clocking') }}"
                        class="{{ url()->current() == route('admin.clocking') ? 'side-menu--active' : '' }} side-menu">
                        <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                        <div class="side-menu__title"> Fichaje </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.patients') }}"
                        class="{{ url()->current() == route('admin.patients') ? 'side-menu--active' : '' }} side-menu">
                        <div class="side-menu__icon"> <i data-lucide="inbox"></i> </div>
                        <div class="side-menu__title"> Pacientes </div>
                    </a>
                </li>
            @endrole
        </ul>
    </nav>
    <!-- END: Side Menu -->

    <!-- BEGIN: Content -->
    <div class="content">
        {{ $slot }}
    </div>
    <!-- END: Content -->
</div>
