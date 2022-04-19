<div x-data="{ department: false, editDepartment: false, position: false, editPosition: false }">

    <x-jet-action-message class="" on="save">
        <div class="alert alert-success show mt-6 w-full max-w-lg mx-auto" role="alert">Registro exitoso</div>
    </x-jet-action-message>

    <div class="mb-5 col-span-2 md:grid md:grid-cols-2 gap-4">
        <div class="mt-6">
            <div class="intro-y block sm:flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Especialidades</h2>
                <div class="flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <button @click="department = true"
                        class="btn box flex items-center text-slate-600 dark:text-slate-300">
                        <span wire:ignore class="w-5 h-5 flex"> <i class="-ml-1 w-4 h-4" data-lucide="plus"></i>
                        </span> Nuevo departamento
                    </button>
                </div>
            </div>
            <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                <table class="table table-report sm:mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">NOMBRE</th>
                            <th class="whitespace-nowrap">DESCRIPCIÓN</th>
                            <th class="text-center whitespace-nowrap">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $depa)
                            <tr class="intro-x">
                                <td>
                                    <a href="" class="font-medium whitespace-nowrap">{{ $depa->name }}</a>
                                </td>
                                <td>
                                    {{-- <b class="font-medium whitespace-nowrap">{{ substr($depa->description, 0, 20) . '...' }}</b> --}}
                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{ substr($depa->description, 0, 20) . '...' }}</div>
                                </td>
                                <td class="table-report__action w-56">
                                    <div wire:ignore class="flex justify-center items-center">
                                        <p wire:click="editDepartment('{{ $depa->id }}')"
                                            @click="editDepartment = !editDepartment"
                                            class="flex items-center mr-3 cursor-pointer">
                                            <i class="-ml-1 w-4 h-4" data-lucide="edit"></i>
                                        </p>
                                        <p @click="Livewire.emit('destroyDepartment', {{ $depa->id }})"
                                            class="flex items-center text-danger cursor-pointer">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2"
                                                data-lucide="trash-2" class="lucide lucide-trash-2 w-4 h-4 mr-1">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
            </div>
        </div>
    </div>

    <div x-show="department" :class="{'show':department, '': !department}" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="department = false, Livewire.emit('resetVariables')">
                <div class="modal-body p-10">
                    <div>
                        <label for="crud-form-1" class="form-label">Nombre del departamento</label>
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
                        <button href="javascript:;" class="btn btn-primary mr-1"
                            @click="department = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="saveDepartment" @click="Livewire.on('save', () => {department = false; })"
                            class="btn btn-primary mr-1">Crear</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div x-show="editDepartment" :class="{'show':editDepartment, '': !editDepartment}" class="modal-personal"
        tabindex="-1" aria-hidden="true">
        <div class="modal-personal-dialog">
            <div class="modal-content" @click.away="editDepartment = false, Livewire.emit('resetVariables')">
                <div class="modal-body p-10 text-center">
                    <div>
                        <label for="crud-form-1" class="form-label">Editar departamento</label>
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
                        <button href="javascript:;" class="btn btn-primary mr-1"
                            @click="editDepartment = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="updateDepartment('{{ $aux }}')"
                            @click="Livewire.on('save', () => {editDepartment = false; })"
                            class="btn btn-primary mr-1">Actualizar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('midone/dist/js/ckeditor-classic.js') }}" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    text: "¡Todos los usuarios asociados a este departamento serán eliminados! ¡Esta acción no se puede revertir!",
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
                            '¡Departamento eliminado!',
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'Los datos no se alteraron'
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
                            '¡cargo/especialidad eliminado!',
                        )
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'Los datos no se alteraron'
                        )
                    }
                })
            });
        </script>
    @endpush
</div>
