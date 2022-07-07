<div x-data="{ department: false, editDepartment: false, showUsers: false }">

    <x-jet-action-message class="" on="save">
        <div class="w-full max-w-lg mx-auto mt-6 alert alert-success show" role="alert">Registro exitoso</div>
    </x-jet-action-message>

    <div class="col-span-2 gap-4 mb-5">
        <div class="mt-6">
            <div class="items-center block h-10 intro-y sm:flex">
                <h2 class="mr-5 text-lg font-medium truncate">Especialidades</h2>
                <div class="flex items-center mt-3 sm:ml-auto sm:mt-0">
                    <div class="mr-2">
                        <button wire:click="printDepartments" class="flex items-center btn box text-slate-600 dark:text-slate-300">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" icon-name="printer" data-lucide="printer"
                                class="block mx-auto lucide lucide-printer">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg> Imprimir
                        </button>

                    </div>

                    <button @click="department = true"
                        class="flex items-center btn box text-slate-600 dark:text-slate-300">
                        <span wire:ignore class="flex w-5 h-5"> <i class="w-4 h-4 -ml-1" data-lucide="plus"></i>
                        </span> Nueva especialidad
                    </button>
                </div>
            </div>
            <div class="mt-8 overflow-auto intro-y lg:overflow-visible sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">NOMBRE</th>
                            <th class="whitespace-nowrap">DESCRIPCIÓN</th>
                            <th class="text-center whitespace-nowrap">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $key => $depa)
                            <tr class="intro-x">
                                <td>
                                    <a @click="setTimeout(() => showUsers = true, 300)"
                                        wire:click="usersDepartment({{ $depa->id }})" href="javascript:;"
                                        class="font-medium whitespace-nowrap">{{ $depa->name }}</a>
                                </td>
                                <td>
                                    {{-- <b class="font-medium whitespace-nowrap">{{ substr($depa->description, 0, 20) . '...' }}</b> --}}
                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                        {{ substr($depa->description, 0, 80) . '...' }}</div>
                                </td>
                                <td class="w-56 table-report__action">
                                    <div wire:ignore class="flex items-center justify-center">
                                        <p wire:click="editDepartment('{{ $depa->id }}')"
                                            @click="editDepartment = !editDepartment"
                                            class="flex items-center mr-3 cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg> Editar
                                        </p>
                                        @if ($key !== 0)
                                        <p @click="Livewire.emit('destroyDepartment', {{ $depa->id }})"
                                            class="flex items-center cursor-pointer text-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                icon-name="trash-2" data-lucide="trash-2"
                                                class="w-4 h-4 mr-1 lucide lucide-trash-2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17">
                                                </line>
                                                <line x1="14" y1="11" x2="14" y2="17">
                                                </line>
                                            </svg> Eliminar
                                        </p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-wrap items-center mt-3 intro-y sm:flex-row sm:flex-nowrap">
            </div>
        </div>
    </div>

    <div x-show="department" :class="{ 'show': department, '': !department }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="department = false, Livewire.emit('resetVariables')">
                <div class="p-10 modal-body">
                    <div>
                        <label for="crud-form-1" class="form-label">Nombre de la especialidad</label>
                        <input wire:model="department" id="crud-form-1" type="text"
                            class="@error('department') border-danger @enderror form-control w-full"
                            placeholder="Ej. Administración">
                        <x-jet-input-error for="department" />
                    </div>
                    <label for="crud-form-3" class="mt-6 form-label">Descripción</label>
                    <textarea wire:model="description" id="crud-form-3"
                        class="@error('description') border-danger @enderror form-control w-full h-20"
                        placeholder="Ej. Pediatría es la especialidad que previene, trata y diagnostica las enfermedades o lesiones de los niños."></textarea>
                    <x-jet-input-error for="description" />
                    <div class="mt-8">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="department = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="saveDepartment" @click="Livewire.on('save', () => {department = false; })"
                            class="mr-1 btn btn-primary">Crear</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div x-show="editDepartment" :class="{ 'show': editDepartment, '': !editDepartment }" class="modal-personal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="editDepartment = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div>
                        <label for="crud-form-1" class="form-label">Editar especialidad</label>
                        <input wire:model="department" id="crud-form-1" type="text"
                            class="@error('department') border-danger @enderror form-control w-full"
                            placeholder="Ej. Administración">
                        <x-jet-input-error for="editDepartment" />
                    </div>
                    <label for="crud-form-3" class="mt-6 form-label">Descripción</label>
                    <textarea wire:model="description" id="crud-form-3"
                        class="@error('description') border-danger @enderror form-control w-full h-20"
                        placeholder="Ej. Pediatría es la especialidad que previene, trata y diagnostica las enfermedades o lesiones de los niños."></textarea>
                    <x-jet-input-error for="description" />
                    <div class="mt-8">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="editDepartment = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="updateDepartment('{{ $aux }}')"
                            @click="Livewire.on('save', () => {editDepartment = false; })"
                            class="mr-1 btn btn-primary">Actualizar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Slide create user -->
    <div x-show="showUsers" :class="{ 'show': showUsers, '': !showUsers }" class="modal-personal modal-slide-over "
        tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="showUsers = false, Livewire.emit('resetVariables')">
                <div class="p-5 modal-header">
                    <h2 class="mr-auto text-base font-medium">{{ $userDepartment }}</h2>
                </div>

                <!-- BEGIN: Weekly Best Sellers -->
                <div class="col-span-12 p-10 mt-6 xl:col-span-4">
                    <div class="flex items-center h-10 intro-y">
                        <h2 class="mr-5 text-lg font-medium truncate">
                            Usuarios asociados a esta Especialidad
                        </h2>
                    </div>
                    <div class="mt-5">
                        @if (!is_null($users) && $users->count())
                            @foreach ($users as $user)
                                <div class="intro-y">
                                    <div class="flex items-center px-4 py-4 mb-3 box zoom-in">
                                        <div class="flex-none w-10 h-10 overflow-hidden rounded-md image-fit">
                                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                                                src="{{ $user->person->user->profile_photo_url }}">
                                        </div>
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">{{ $user->person->name }}</div>
                                            <div class="text-slate-500 text-xs mt-0.5">
                                                {{ $user->person->user->getRoleNames()->first() }}</div>
                                        </div>
                                        {{-- <div class="px-2 py-1 text-xs font-medium text-white rounded-full cursor-pointer bg-success">137 Sales</div> --}}
                                    </div>
                                </div>
                            @endforeach
                            <a @click="showUsers = false" href="javascript:;"
                                class="block w-full py-4 text-center border border-dotted rounded-md intro-y border-slate-400 dark:border-darkmode-300 text-slate-500">Cerrar</a>
                        @else
                            <div class="intro-y">
                                <div class="flex items-center mb-2 zoom-in alert alert-outline-danger alert-dismissible show"
                                    role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    <p class="ml-6">No hay usuarios asociado a esta Especialidad</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- END: Weekly Best Sellers -->
            </div>
        </div>
    </div>
    <!-- END: Slide create user -->

    @push('scripts')
        <script src="{{ asset('midone/dist/js/ckeditor-classic.js') }}" defer></script>
        <script>
            Livewire.on('destroyDepartment', Id => {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: '¿Está seguro?',
                    text: "¡Todos los usuarios asociados a esta Especialidad serán eliminados! ¡Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: '¡No!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteDepartment', Id)
                        console.log(Id);
                        swalWithBootstrapButtons.fire(
                            '¡Especialidad eliminada!', )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelado', 'Los datos no se alteraron'
                        )
                    }
                })
            });
        </script>

        <script>
            Livewire.on('destroyPosition', Id => {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: '¿Está seguro?',
                    text: "¡Todos los usuarios asociados a este cargo/especialidad serán eliminados! ¡Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '¡Sí!',
                    cancelButtonText: '¡No!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deletePosition', Id)
                        console.log(Id);
                        swalWithBootstrapButtons.fire(
                            '¡cargo/especialidad eliminado!', )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelado', 'Los datos no se alteraron'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
