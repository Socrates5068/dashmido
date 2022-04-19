<div x-data="{ modal: false, modalDelete: false, modalSlide: false, editUser: false }">
    <x-jet-action-message class="" on="save">
        <div class="alert alert-success show mt-6 w-full max-w-lg mx-auto" role="alert">Registro exitoso</div>
    </x-jet-action-message>
    <x-jet-action-message class="" on="deleteRole">
        <div class="alert alert-danger show mt-6 w-full max-w-lg mx-auto" role="alert">Eliminación exitosa</div>
    </x-jet-action-message>
    <h2 class="intro-y text-lg font-medium mt-10">
        Usuarios
    </h2>
    {{-- BEGIN: User list --}}
    <div class="grid grid-cols-12 gap-6 mt-5" id="users-staff">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <button class="btn btn-primary shadow-md mr-2" @click="modalSlide = true">Agregar
                usuario</button>
            <div wire:ignore class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4"
                            data-lucide="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <button @click="modal = true" class="dropdown-item">
                                <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                Agregar Roles </button>
                        </li>
                        <li>
                            <button @click="modalDelete = true" class="dropdown-item">
                                <i data-lucide="eye-off" class="w-4 h-4 mr-2"></i> Eliminar Roles </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">{{ $users->links('pagination::message') }}</div>
            <div x-data="{ message: '' }" class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Buscar..." x-model="message"
                        @input="Livewire.emit('updateSearch', message)">
                    <i class=" w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @foreach ($users as $user)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                                src="{{ $user->user->profile_photo_url }}">
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $user->name }}</a>
                            <div class="text-slate-500 text-xs mt-0.5">{{ $user->user->getRoleNames()->first() }}</div>
                        </div>
                        <div class="flex mt-4 lg:mt-0">
                            @isset($user->user->email_verified_at)
                                <button wire:click="register('{{ $user->id }}')" class="btn btn-success py-1 px-2 mr-2">    
                                    Alta
                                </button>
                            @else
                                <button wire:click="register('{{ $user->id }}')" class="btn btn-danger py-1 px-2 mr-2">    
                                    Baja
                                </button>
                            @endisset
                            </button>
                            <button wire:click="editUser('{{ $user->id }}')" @click="editUser = true"
                                class="btn btn-outline-secondary py-1 px-2">Editar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- BEGIN: Users Layout -->
        <!-- END: Pagination -->

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full hidden md:block">
                {{ $users->links() }}
            </nav>
            <nav class="w-full sm:w-auto sm:mr-auto md:hidden">
                {{ $users->links('pagination::tailwind') }}
            </nav>
            <select wire:model="paginate" class="w-20 form-select box mt-3 sm:mt-0">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="35">35</option>
                <option value="50">50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
    {{-- END: user list --}}

    <!-- BEGIN: Modal add role -->
    <div x-show="modal" :class="{'show':modal, '': !modal}" class="modal-personal" tabindex="-1" aria-hidden="true">
        <div class="mt-20 modal-personal-dialog overflow-hidden">
            <div class="modal-content" @click.away="modal = false, Livewire.emit('resetVariables')">
                <div class="modal-body p-10 text-center">
                    <div class="mb-6">
                        <label for="regular-form-1" class="form-label">Nombre del rol</label>
                        <input wire:model.defer="role" name="role" type="text" class="form-control"
                            placeholder="Ej. Médico general">
                        <x-jet-input-error for="role" />
                    </div>

                    <label>Permisos</label>
                    <div class="flex flex-col sm:flex-row mt-2">
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.create_user" class="form-check-input"
                                    type="checkbox">
                                Crear Usuarios
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.read_user" class="form-check-input"
                                    type="checkbox">
                                Ver Usuarios
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.update_user" class="form-check-input"
                                    type="checkbox">
                                Editar Usuarios
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row mt-2">
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.register_user" class="form-check-input"
                                    type="checkbox">
                                Dar Alta
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.deregister_user" class="form-check-input"
                                    type="checkbox">
                                Dar Baja
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.read_clocking" class="form-check-input"
                                    type="checkbox">
                                Ver fichaje
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row mt-2">
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.update_clocking" class="form-check-input"
                                    type="checkbox">
                                Editar Fichaje
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.delete_clocking" class="form-check-input"
                                    type="checkbox">
                                Eliminar Fichaje
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.create_history" class="form-check-input"
                                    type="checkbox">
                                Crear Historia
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row mt-2 mb-8">
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.read_history" class="form-check-input"
                                    type="checkbox">
                                Ver Historia
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.update_history" class="form-check-input"
                                    type="checkbox">
                                Editar Historia
                            </label>
                        </div>
                        <div class="form-check mr-2">
                            <label class="form-check-label">
                                <input wire:model.defer="permissions.delete_history" class="form-check-input"
                                    type="checkbox">
                                Eliminar Historia
                            </label>
                        </div>
                    </div>

                    <div>
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="btn btn-primary mr-1"
                            @click="modal = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="saveRole" @click="Livewire.on('save', () => {modal = false; })"
                            class="btn btn-primary mr-1">Crear</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal add role -->

    <!-- BEGIN: Modal delete role -->
    <div x-show="modalDelete" :class="{'show':modalDelete, '': !modalDelete}" class="modal-personal" tabindex="-1" aria-hidden="true">
        <div class="mt-20 modal-personal-dialog overflow-hidden">
            <div class="modal-content" @click.away="modalDelete = false">
                <div class="modal-body p-10 text-center">
                    <div>
                        <label>Seleccionar rol a eliminar</label>
                        <div class="mt-2">
                            <select wire:model="deleteRole" data-placeholder="Select your favorite actors"
                                class="form-control w-full">
                                <option value="">Seleeciona un rol</option>
                                @foreach ($roles as $role)
                                @if($role->name !== 'Paciente')
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                                @endforeach
                            </select>
                            <x-jet-input-error for="deleteRole" />
                        </div>
                    </div>
                    <div class="mt-20">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="btn btn-primary mr-1"
                            @click="modalDelete = false">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="deleteRole"
                            @click="Livewire.on('deleteRole', () => {modalDelete = false; } )"
                            class="btn btn-primary mr-1">Eliminar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal delete role -->

    <!-- BEGIN: Slide create user -->
    <div x-show="modalSlide" :class="{'show':modalSlide, '': !modalSlide}" class="modal-personal modal-slide-over" tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="modalSlide = false, Livewire.emit('resetVariables')">
                <div class="modal-header p-5">
                    <h2 class="font-medium text-base mr-auto">Registrar usuario</h2>
                </div>

                <div class="-mt-4 modal-body p-10">
                    <div class="mb-4 text-slate-500">
                        Los campos marcados con un <span class="font-bold">(*)</span> son obligatorios.
                    </div>
                    <div>
                        <label for="name" class="form-label">*Nombres</label>
                        <input wire:model="user.name" id="name" type="text" class="form-control"
                            placeholder="Ej. Juan Ambrosio">
                        <x-jet-input-error for="user.name" />
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-4">
                        <div class="mt-3">
                            <label for="f_last_name" class="form-label">*Apellido paterno</label>
                            <input wire:model="user.f_last_name" id="f_last_name" type="text" class="form-control"
                                placeholder="Ej. Aramayo">
                            <x-jet-input-error for="user.f_last_name" />
                        </div>
                        <div class="mt-3">
                            <label for="m_last_name" class="form-label">*Apellido materno</label>
                            <input wire:model="user.m_last_name" id="m_last_name" type="text" class="form-control"
                                placeholder="Ej. Martinez">
                            <x-jet-input-error for="user.m_last_name" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-4">
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
                    <div class="md:grid md:grid-cols-2 gap-4">
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
                        <label for="role" class="form-label">*Cargo/Especialidad</label>
                        <select wire:model="role" data-placeholder="Select your favorite actors"
                            class="form-control w-full" id="role">
                            <option value=" " selected>Selecciona un rol</option>
                            @foreach ($roles as $role)
                                @if($role->name !== 'Paciente')
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="role" />
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-4">
                        <div class="mt-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input disabled wire:model="user.ci" id="username" type="text" class="form-control"">
                        </div>
                        <div class="                                      mt-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input wire:model="user.ci" id="password" type="text" class="form-control" disabled>
                        </div>
                    </div>

                    <button class="mt-10 btn btn-danger shadow-md mr-2"
                        @click="modalSlide = false, Livewire.emit('resetVariables')">Cerrar</button>

                    <button wire:click="saveUser" @click="Livewire.on('save', () => {modalSlide = false; } )"
                        class="btn btn-primary shadow-md mr-2">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Slide create user -->

    <!-- BEGIN: Slide edit user -->
    <div x-show="editUser" :class="{'show':editUser, '': !editUser}" class="modal-personal modal-slide-over" tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="editUser = false, Livewire.emit('resetVariables')">
                <div class="modal-header p-5">
                    <h2 class="font-medium text-base mr-auto">Editar usuario</h2>
                </div>
                <div class="-mt-4 modal-body p-10">
                    <div class="mb-4 text-slate-500">
                        Los campos marcados con un <span class="font-bold">(*)</span> son obligatorios.
                    </div>
                    <div>
                        <label for="name" class="form-label">*Nombres</label>
                        <input wire:model="user.name" id="name" type="text" class="form-control"
                            placeholder="Ej. Juan Ambrosio">
                        <x-jet-input-error for="user.name" />
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-4">
                        <div class="mt-3">
                            <label for="f_last_name" class="form-label">*Apellido paterno</label>
                            <input wire:model="user.f_last_name" id="f_last_name" type="text" class="form-control"
                                placeholder="Ej. Aramayo">
                            <x-jet-input-error for="user.f_last_name" />
                        </div>
                        <div class="mt-3">
                            <label for="m_last_name" class="form-label">*Apellido materno</label>
                            <input wire:model="user.m_last_name" id="m_last_name" type="text" class="form-control"
                                placeholder="Ej. Martinez">
                            <x-jet-input-error for="user.m_last_name" />
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-4">
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
                    <div class="md:grid md:grid-cols-2 gap-4">
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
                        <label for="role" class="form-label">*Cargo/Especialidad</label>
                        <select wire:model="role" data-placeholder="Select your favorite actors"
                            class="form-control w-full" id="role">
                            <option value=" " selected>Selecciona un rol</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="role" />
                    </div>
                    <div class="md:grid md:grid-cols-2 gap-4">
                        <div class="mt-3">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <input disabled wire:model="user.ci" id="username" type="text" class="form-control"">
                        </div>
                    </div>

                            <button @click=" editUser=false, Livewire.emit('resetVariables')"
                                class="mt-10 btn btn-danger shadow-md mr-2">Cerrar</button>

                            <button wire:click="updateUser('{{ $aux }}')"
                                class="btn btn-primary shadow-md mr-2"
                                @click="Livewire.on('save', () => {editUser = false; } )">Guardar</button>

                            <button wire:click="resetPassword('{{ $aux }}')"
                                class="btn btn-warning shadow-md mr-2"
                                @click="Livewire.on('save', () => {editUser = false; } )">Restablecer
                                contraseña</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Slide edit user -->
</div>
