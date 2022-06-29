<div x-data="{ modal: false, modalDelete: false, modalSlide: false, editUser: false }">
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Pacientes'])
    </div>

    <div class="mb-5">
        <x-jet-action-message class="" on="save">
            <div class="w-full max-w-lg mx-auto mt-6 alert alert-success show" role="alert">Registro exitoso</div>
        </x-jet-action-message>
        <x-jet-action-message class="" on="deleteRole">
            <div class="w-full max-w-lg mx-auto mt-6 alert alert-danger show" role="alert">Eliminación exitosa</div>
        </x-jet-action-message>
        <h2 class="mt-10 text-lg font-medium intro-y">
            Pacientes
        </h2>

        <div class="flex flex-wrap items-center col-span-12 mt-2 intro-y sm:flex-nowrap">
            <button class="mr-2 shadow-md btn btn-primary" @click="modalSlide = true">Agregar
                paciente</button>
            <div class="hidden mx-auto md:block text-slate-500">{{ $users->links('pagination::message') }}</div>
        </div>

        {{-- BEGIN: User list --}}
        @if ($users->count())
            <div class="grid grid-cols-12 gap-6 mt-5" id="users-staff">
                <!-- BEGIN: Users Layout -->
                @foreach ($users as $user)
                    <div class="col-span-12 intro-y md:col-span-6">
                        <div class="box">
                            <div class="flex flex-col items-center p-5 lg:flex-row">
                                <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                    <img alt="Midone - HTML Admin Template" class="rounded-fuall"
                                        src="{{ !is_null($user->user) ? $user->user->profile_photo_url : asset('midone/dist/images/avatar.jpg') }}">
                                </div>
                                <div class="mt-3 text-center lg:ml-2 lg:mr-auto lg:text-left lg:mt-0">
                                    <a {{-- href="{{ route('admin.history', $user->id) }}" --}} class="font-medium">{{ $user->name }}</a>
                                    <div class="text-slate-500 text-xs mt-0.5">
                                        {{ !is_null($user->user) ? $user->user->getRoleNames()->first() : 'Paciente' }}
                                    </div>
                                </div>
                                <div class="flex mt-4 lg:mt-0">
                                    @if ($user->user)
                                        @can('create users')
                                            @isset($user->user->email_verified_at)
                                                <button wire:click="register('{{ $user->id }}')"
                                                    class="px-2 py-1 mr-2 btn btn-success">
                                                    Activo
                                                </button>
                                            @else
                                                <button wire:click="register('{{ $user->id }}')"
                                                    class="px-2 py-1 mr-2 btn btn-danger">
                                                    Inactivo
                                                </button>
                                            @endisset
                                        @endcan
                                        </button>
                                        <button wire:click="editUser('{{ $user->id }}')" @click="editUser = true"
                                            class="px-2 py-1 btn btn-outline-secondary">Editar</button>
                                    @endif
                                        {{-- <button wire:click="editUser('{{ $user->id }}')" @click="editUser = true"
                                            class="px-2 py-1 btn btn-outline-secondary">Editar</button> --}}
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
            <div wire:ignore class="flex items-center w-full max-w-lg mx-auto mt-6 alert alert-dark show"
                role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p class="ml-3"> No existen pacientes con esos datos </p>
            </div>
        @endif

        <!-- BEGIN: Slide create user -->
        <div x-show="modalSlide" :class="{ 'show': modalSlide, '': !modalSlide }"
            class="modal-personal modal-slide-over" tabindex="-1" aria-hidden="true">
            <div class="modal-personal-dialog">
                <div class="modal-content" @click.away="modalSlide = false, Livewire.emit('resetVariables')">
                    <div class="p-5 modal-header">
                        <h2 class="mr-auto text-base font-medium">Registrar usuario</h2>
                    </div>

                    <div class="p-10 -mt-4 modal-body">
                        <div class="mb-4 text-slate-500">
                            Los campos marcados con un <span class="font-bold">(*)</span> son obligatorios.
                        </div>
                        {{-- <x-jet-validation-errors class="mb-4" /> --}}
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
                                <label for="telephone" class="form-label">*Telefono/Celular</label>
                                <input wire:model="user.telephone" id="telephone" type="text"
                                    class="form-control" placeholder="Ej. 8765464">
                                <x-jet-input-error for="user.telephone" />
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
                        </div>
                        <div class="gap-4 md:grid md:grid-cols-2">
                            <div class="mt-3">
                                <label for="blood_type" class="form-label">Tipo de sangre</label>
                                <select wire:model="user.blood_type" class="form-select" name=""
                                    id="blood_type">
                                    <option value="" selected disabled>Selecciona una opción</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                                <x-jet-input-error for="user.blood_type" />
                            </div>
                            <div class="mt-3">
                                <label for="old" class="form-label">Edad</label>
                                <input wire:model="user.old" id="old" type="text" class="form-control"
                                    placeholder="40">
                                <x-jet-input-error for="user.old" />
                            </div>
                        </div>

                        <div class="gap-4 md:grid md:grid-cols-2">
                            <div class="mt-3">
                                <label for="weight" class="form-label">Peso (en kilos)</label>
                                <input wire:model="user.weight" id="weight" type="text" class="form-control"
                                    placeholder="70">
                                <x-jet-input-error for="user.weight" />
                            </div>
                            <div class="mt-3">
                                <label for="height" class="form-label">Altura (en metros)</label>
                                <input wire:model="user.height" id="height" type="text" class="form-control"
                                    placeholder="1.68">
                            </div>
                            <x-jet-input-error for="user.height" />
                        </div>

                        <div class="gap-4 md:grid md:grid-cols-2">
                            <div class="mt-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input disabled wire:model="user.ci" id="username" type="text"
                                    class="form-control"">
                            </div>
                            <div class="mt-3 ">
                                <label for="password" class="form-label">Contraseña</label>
                                <input wire:model="user.ci" id="password" type="text" class="form-control"
                                    disabled>
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
                                <label for="telephone" class="form-label">*Telefono/Celular</label>
                                <input wire:model="user.telephone" id="telephone" type="text"
                                    class="form-control" placeholder="Ej. 8765464">
                                <x-jet-input-error for="user.telephone" />
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
                        </div>

                        <div class="gap-4 md:grid md:grid-cols-2">
                            <div class="mt-3">
                                <label for="blood" class="form-label">Tipo de sangre</label>
                                <input wire:model="user.blood_type" id="blood" type="text"
                                    class="form-control" placeholder="B+">
                                <x-jet-input-error for="user.blood_type" />
                            </div>
                            <div class="mt-3">
                                <label for="old" class="form-label">Edad</label>
                                <input wire:model="user.old" id="old" type="text" class="form-control"
                                    placeholder="40">
                                <x-jet-input-error for="user.old" />
                            </div>
                        </div>

                        <div class="gap-4 md:grid md:grid-cols-2">
                            <div class="mt-3">
                                <label for="weight" class="form-label">Peso</label>
                                <input wire:model="user.weight" id="weight" type="text" class="form-control"
                                    placeholder="70 kg">
                                <x-jet-input-error for="user.weight" />
                            </div>
                            <div class="mt-3">
                                <label for="height" class="form-label">Altura</label>
                                <input wire:model="user.height" id="height" type="text" class="form-control"
                                    placeholder="168 cm">
                                <x-jet-input-error for="user.height" />
                            </div>
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

                        <button wire:click="resetPassword('{{ $aux }}')"
                            class="mr-2 shadow-md btn btn-warning"
                            @click="Livewire.on('save', () => {editUser = false; } )">Restablecer
                            contraseña</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Slide edit user -->
    </div>
</div>
