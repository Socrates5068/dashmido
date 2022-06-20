<div x-data="{ modal: false, modalDelete: false, modalSlide: false, editUser: false }">
    <x-jet-action-message class="" on="save">
        <div class="w-full max-w-lg mx-auto mt-6 alert alert-success show" role="alert">Registro exitoso</div>
    </x-jet-action-message>
    <x-jet-action-message class="" on="deleteRole">
        <div class="w-full max-w-lg mx-auto mt-6 alert alert-danger show" role="alert">Eliminación exitosa</div>
    </x-jet-action-message>
    <h2 class="mt-10 text-lg font-medium intro-y">
        Usuarios {{ $aux }}
    </h2>
    @if ($users->count())
        {{-- BEGIN: User list --}}
        <div class="grid grid-cols-12 gap-6 mt-5" id="users-staff">
            <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y sm:flex-nowrap">
                <button class="mr-2 shadow-md btn btn-primary" @click="modalSlide = true">Agregar
                    usuario</button>
                <div class="dropdown">
                    <button class="px-2 dropdown-toggle btn box" aria-expanded="false" data-tw-toggle="dropdown">
                        <span class="flex items-center justify-center w-5 h-5"> <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg> </span>
                    </button>
                    <div class="w-40 dropdown-menu">
                        <ul class="dropdown-content">
                            <li>
                                <button @click="modal = true" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Agregar Roles </button>
                            </li>
                            <li>
                                <button @click="modalDelete = true" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg> Eliminar Roles </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hidden mx-auto md:block text-slate-500">{{ $users->links('pagination::message') }}</div>
                {{-- <div x-data="{ message: '' }" class="w-full mt-3 sm:w-auto sm:mt-0 sm:ml-auto md:ml-0">
                <div class="relative w-56 text-slate-500">
                    <input type="text" class="w-56 pr-10 form-control box" placeholder="Buscar..." x-model="message"
                        @input="Livewire.emit('updateSearch', message)">
                    <i class="absolute inset-y-0 right-0 w-4 h-4 my-auto mr-3 " data-lucide="search"></i>
                </div>
            </div> --}}
            </div>
            <!-- BEGIN: Users Layout -->
            @foreach ($users as $user)
                <div class="col-span-12 intro-y md:col-span-6">
                    <div class="box">
                        <div class="absolute right-0 p-1 -mt-6">
                            <svg wire:click="deleteUser({{ $user->person->id }})" xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 text-red-600 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex flex-col items-center p-5 lg:flex-row">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                                    src="{{ $user->person->user->profile_photo_url }}">
                            </div>
                            <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:text-left lg:mt-0">
                                <a href="" class="font-medium">{{ $user->person->name }}</a>
                                <div class="text-slate-500 text-xs mt-0.5">
                                    {{ $user->person->user->getRoleNames()->first() }}</div>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                @isset($user->person->user->email_verified_at)
                                    <button wire:click="register('{{ $user->person->id }}')"
                                        class="px-2 py-1 mr-2 btn btn-success">
                                        Activo
                                    </button>
                                @else
                                    <button wire:click="register('{{ $user->person->id }}')"
                                        class="px-2 py-1 mr-2 btn btn-danger">
                                        Inactivo
                                    </button>
                                @endisset
                                </button>
                                <button wire:click="editUser('{{ $user->person->id }}')" @click="editUser = true"
                                    class="px-2 py-1 btn btn-outline-secondary">Editar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- BEGIN: Users Layout -->
            <!-- END: Pagination -->

            <div class="flex flex-wrap items-center col-span-12 intro-y sm:flex-row sm:flex-nowrap">
                <nav class="hidden w-full md:block">
                    {{ $users->links() }}
                </nav>
                <nav class="w-full sm:w-auto sm:mr-auto md:hidden">
                    {{ $users->links('pagination::tailwind') }}
                </nav>
                <select wire:model="paginate" class="w-20 mt-3 form-select box sm:mt-0">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="35">35</option>
                    <option value="50">50</option>
                </select>
            </div>
            <!-- END: Pagination -->
        </div>
        {{-- END: user list --}}
    @else
        <div wire:ignore class="flex items-center w-full max-w-lg mx-auto mt-6 alert alert-dark show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <p class="ml-3"> No existen usuarios con esos datos </p>
        </div>
    @endif

    <!-- BEGIN: Modal add role -->
    <div x-show="modal" :class="{ 'show': modal, '': !modal }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="modal = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="mb-6">
                        <label for="regular-form-1" class="form-label">Nombre del rol</label>
                        <input wire:model.defer="role" name="role" type="text" class="form-control"
                            placeholder="Ej. Médico general">
                        <x-jet-input-error for="role" />
                    </div>

                    <label>Permisos</label>
                    <div class="flex flex-col mt-2 sm:flex-row">
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.create_user" class="form-check-input"
                                    type="checkbox">
                                Crear Usuarios
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.read_user" class="form-check-input"
                                    type="checkbox">
                                Ver Usuarios
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.update_user" class="form-check-input"
                                    type="checkbox">
                                Editar Usuarios
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col mt-2 sm:flex-row">
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.register_user" class="form-check-input"
                                    type="checkbox">
                                Dar Alta
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.deregister_user" class="form-check-input"
                                    type="checkbox">
                                Dar Baja
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.read_clocking" class="form-check-input"
                                    type="checkbox">
                                Ver fichaje
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col mt-2 sm:flex-row">
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.update_clocking" class="form-check-input"
                                    type="checkbox">
                                Editar Fichaje
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.delete_clocking" class="form-check-input"
                                    type="checkbox">
                                Eliminar Fichaje
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.create_history" class="form-check-input"
                                    type="checkbox">
                                Crear Historia
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col mt-2 mb-8 sm:flex-row">
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.read_history" class="form-check-input"
                                    type="checkbox">
                                Ver Historia
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.update_history" class="form-check-input"
                                    type="checkbox">
                                Editar Historia
                            </label>
                        </div>
                        <div class="mr-2 form-check">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.delete_history" class="form-check-input"
                                    type="checkbox">
                                Eliminar Historia
                            </label>
                        </div>
                    </div>

                    <div>
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="modal = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="saveRole" @click="Livewire.on('save', () => {modal = false; })"
                            class="mr-1 btn btn-primary">Crear</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal add role -->

    <!-- BEGIN: Modal delete role -->
    <div x-show="modalDelete" :class="{ 'show': modalDelete, '': !modalDelete }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="modalDelete = false">
                <div class="p-10 text-center modal-body">
                    <div>
                        <label>Seleccionar rol a eliminar</label>
                        <div class="mt-2">
                            <select wire:model="deleteRole" data-placeholder="Select your favorite actors"
                                class="w-full form-control">
                                <option value="">Seleeciona un rol</option>
                                @foreach ($roles as $role)
                                    @if ($role->name !== 'Paciente')
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <x-jet-input-error for="deleteRole" />
                        </div>
                    </div>
                    <div class="mt-20">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="modalDelete = false">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="deleteRole"
                            @click="Livewire.on('deleteRole', () => {modalDelete = false; } )"
                            class="mr-1 btn btn-primary">Eliminar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal delete role -->

    <!-- BEGIN: Slide create user -->
    <div x-show="modalSlide" :class="{ 'show': modalSlide, '': !modalSlide }" class="modal-personal modal-slide-over"
        tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="modalSlide = false, Livewire.emit('resetVariables')">
                <div class="p-5 modal-header">
                    <h2 class="mr-auto text-base font-medium">Registrar usuario</h2>
                </div>

                <div class="p-10 -mt-4 modal-body">
                    <div class="mb-4 text-slate-500">
                        Los campos marcados con un <span class="font-bold">(*)</span> son obligatorios.
                    </div>
                    <div>
                        <label for="name" class="form-label">*Nombres</label>
                        <input wire:model="user.name" id="name" type="text" class="form-control"
                            placeholder="Ej. Juan Ambrosio">
                        <x-jet-input-error for="user.name" />
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="f_last_name" class="form-label">*Apellido paterno</label>
                            <input wire:model="user.f_last_name" id="f_last_name" type="text"
                                class="form-control" placeholder="Ej. Aramayo">
                            <x-jet-input-error for="user.f_last_name" />
                        </div>
                        <div class="mt-3">
                            <label for="m_last_name" class="form-label">*Apellido materno</label>
                            <input wire:model="user.m_last_name" id="m_last_name" type="text"
                                class="form-control" placeholder="Ej. Martinez">
                            <x-jet-input-error for="user.m_last_name" />
                        </div>
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="ci" class="form-label">*C.I.</label>
                            <input wire:model="user.ci" id="ci" type="text" class="form-control"
                                placeholder="Ej. 8765464">
                            <x-jet-input-error for="user.ci" />
                        </div>
                        <div class="mt-3">
                            <label for="address" class="form-label">*Dirección</label>
                            <input wire:model="user.address" id="address" type="text" class="form-control"
                                placeholder="Ej. Calle Hoyos 150">
                            <x-jet-input-error for="user.address" />
                        </div>
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="telephone" class="form-label">*Teléfono o celular</label>
                            <input wire:model="user.telephone" id="telephone" type="text" class="form-control"
                                placeholder="Ej. 6225635 o 74859632">
                            <x-jet-input-error for="user.telephone" />
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Correo</label>
                            <input wire:model="user.email" id="email" type="text" class="form-control"
                                placeholder="Ej. ambrosio@gmail.com">
                            <x-jet-input-error for="user.email" />
                        </div>
                    </div>
                    <div class="mt-3">
                        <label for="sex" class="form-label">Sexo</label>
                        <select wire:model="user.sex" data-placeholder="Seleccione un sexo"
                            class="w-full form-control" id="sex">
                            <option value="">Seleccione un sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        <x-jet-input-error for="user.sex" />
                    </div>
                    <div class="mt-3">
                        <label for="role" class="form-label">*Asignar rol</label>
                        <select wire:model="role" data-placeholder="Select your favorite actors"
                            class="w-full form-control" id="role">
                            <option value=" " selected>Selecciona un rol</option>
                            @foreach ($roles as $role)
                                @if ($role->name !== 'Paciente')
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="role" />
                    </div>
                    <div class="mt-3">
                        <label for="department" class="form-label">*Asignar una especialidad</label>
                        <select wire:model="user.department" data-placeholder="Select your favorite actors"
                            class="w-full form-control" id="role">
                            <option value=" " selected>Seleccione un departemento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="user.department" />
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input disabled wire:model="user.ci" id="username" type="text"
                                class="form-control"">
                        </div>
                        <div class="mt-3 ">
                            <label for="password" class="form-label">Contraseña</label>
                            <input wire:model="user.ci" id="password" type="text" class="form-control" disabled>
                        </div>
                    </div>

                    <button class="mt-10 mr-2 shadow-md btn btn-danger"
                        @click="modalSlide = false, Livewire.emit('resetVariables')">Cerrar</button>

                    <button wire:click="saveUser" @click="Livewire.on('save', () => {modalSlide = false; } )"
                        class="mr-2 shadow-md btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Slide create user -->

    <!-- BEGIN: Slide edit user -->
    <div x-show="editUser" :class="{ 'show': editUser, '': !editUser }" class="modal-personal modal-slide-over"
        tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="editUser = false, Livewire.emit('resetVariables')">
                <div class="p-5 modal-header">
                    <h2 class="mr-auto text-base font-medium">Editar usuario</h2>
                </div>
                <x-jet-validation-errors class="mt-4 mb-4" />
                <div class="p-10 -mt-4 modal-body">
                    <div class="mb-4 text-slate-500">
                        Los campos marcados con un <span class="font-bold">(*)</span> son obligatorios.
                    </div>
                    <div>
                        <label for="name" class="form-label">*Nombres</label>
                        <input wire:model="user.name" id="name" type="text" class="form-control"
                            placeholder="Ej. Juan Ambrosio">
                        <x-jet-input-error for="user.name" />
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="f_last_name" class="form-label">*Apellido paterno</label>
                            <input wire:model="user.f_last_name" id="f_last_name" type="text"
                                class="form-control" placeholder="Ej. Aramayo">
                            <x-jet-input-error for="user.f_last_name" />
                        </div>
                        <div class="mt-3">
                            <label for="m_last_name" class="form-label">*Apellido materno</label>
                            <input wire:model="user.m_last_name" id="m_last_name" type="text"
                                class="form-control" placeholder="Ej. Martinez">
                            <x-jet-input-error for="user.m_last_name" />
                        </div>
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="ci" class="form-label">*C.I.</label>
                            <input wire:model="user.ci" id="ci" type="text" class="form-control"
                                placeholder="Ej. 8765464">
                            <x-jet-input-error for="user.ci" />
                        </div>
                        <div class="mt-3">
                            <label for="address" class="form-label">*Dirección</label>
                            <input wire:model="user.address" id="address" type="text" class="form-control"
                                placeholder="Ej. Calle Hoyos 150">
                            <x-jet-input-error for="user.address" />
                        </div>
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="telephone" class="form-label">*Teléfono o celular</label>
                            <input wire:model="user.telephone" id="telephone" type="text" class="form-control"
                                placeholder="Ej. 6225635 o 74859632">
                            <x-jet-input-error for="user.telephone" />
                        </div>
                        <div class="mt-3">
                            <label for="email" class="form-label">Correo</label>
                            <input wire:model="user.email" id="email" type="text" class="form-control"
                                placeholder="Ej. ambrosio@gmail.com">
                        </div>
                        <x-jet-input-error for="user.email" />
                    </div>
                    <div class="mt-3">
                        <label for="sex" class="form-label">Sexo</label>
                        <select wire:model="user.sex" data-placeholder="Seleccione un sexo"
                            class="w-full form-control" id="sex">
                            <option value="">Seleccione un sexo</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                        <x-jet-input-error for="user.sex" />
                    </div>
                    <div class="mt-3">
                        <label for="role" class="form-label">*Asignar rol</label>
                        <select wire:model="role" data-placeholder="Select your favorite actors"
                            class="w-full form-control" id="role">
                            <option value=" " selected>Selecciona un rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="department" class="form-label">*Asignar una especialidad</label>
                        <select wire:model="user.department" data-placeholder="Select your favorite actors"
                            class="w-full form-control" id="role">
                            <option value=" " selected>Seleccione un departemento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="user.department" />
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input disabled wire:model="user.ci" id="username" type="text"
                                class="form-control"">
                        </div>
                    </div>

                    <button @click=" editUser=false, Livewire.emit('resetVariables')"
                        class="mt-10 mr-2 shadow-md btn btn-danger">Cerrar</button>

                    <button wire:click="updateUser('{{ $aux }}')" class="mr-2 shadow-md btn btn-primary"
                        @click="Livewire.on('save', () => {editUser = false; } )">Guardar</button>

                    <button wire:click="resetPassword('{{ $aux }}')" class="mr-2 shadow-md btn btn-warning"
                        @click="Livewire.on('save', () => {editUser = false; } )">Restablecer
                        contraseña</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Slide edit user -->
</div>
