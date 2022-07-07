<div x-data="{ modal: false }">
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Fichajes'])
    </div>

    <x-notification-message on="delete">
        <!-- BEGIN: Notification Content -->
        <div class="flex toastify-content">
            <div class="relative flex w-full max-w-lg mx-auto my-auto bg-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-4 mr-4">
                    <div class="font-medium">¡Registro exitoso!</div>
                    <div class="mt-1 text-slate-500">El horario a sido eliminado correctamente.</div>
                </div>
            </div>
        </div>
        <!-- END: Notification Content -->
    </x-notification-message>

    <!-- BEGIN: Notification Content -->
    <div id="save" class="flex hidden toastify-content">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="ml-4 mr-4">
            <div class="font-medium">¡Registro exitoso!</div>
            <div class="mt-1 text-slate-500">El horario a sido agregado correctamente.</div>
        </div>
    </div>
    <!-- END: Notification Content -->

    <div class="mt-8">
        <button @click="modal = true" class="mb-2 mr-1 w-36 btn btn-primary">Crear horario</button>
    </div>

    @if ($schedules->count())
        @foreach ($schedules as $schedule)
            <div class="relative p-8 mt-8 bg-white rounded-lg shadow-lg">
                <div class="absolute right-0 p-5 -mt-8">
                    <svg @click="deleteTime({{ $schedule->id }})" 
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-red-600 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <h2 class="text-lg font-medium intro-y">
                    {{ $schedule->name }}
                </h2>

                <div class="grid grid-cols-2 gap-6 mt-5 intro-y">
                    <div class="">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">#</th>
                                    <th class="whitespace-nowrap">Inicio</th>
                                    <th class="whitespace-nowrap">Fin</th>
                                    <th class="whitespace-nowrap">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $j = 1;
                                    $time = json_decode($schedule->time);
                                @endphp
                                @for ($i = 0; $i < count($time); $i = $i + 2)
                                    <tr>
                                        <td>{{ $j }}</td>
                                        <td>{{ $time[$i] }}</td>
                                        <td>{{ $time[$i + 1] }}</td>
                                        @php
                                            $j++;
                                        @endphp
                                        <td>
                                            <div class="flex">
                                                <svg wire:click="edit('{{ $schedule->id }}', '{{ $i }}')"
                                                    class="w-6 h-6 ml-1 mr-1 text-green-600 cursor-pointer"
                                                    xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                @if ($i == count($time) - 2)
                                                    <svg wire:click="delete('{{ $schedule->id }}', '{{ $i }}')"
                                                        class="w-6 h-6 text-red-600 cursor-pointer"
                                                        xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                        stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                @endif

                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div wire:ignore>
                        @livewire('admin.clocking.time', ['schedule' => $schedule])
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="p-8 mt-8">
            <div class="mb-2 alert alert-dark show" role="alert">Aún no hay horarios registrados</div>
        </div>
    @endif

    <div x-show="modal" :class="{ 'show': modal, '': !modal }" class="modal-personal" tabindex="-1" aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="modal = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="mb-6">
                        <label for="regular-form-1" class="form-label">Nombre del horario</label>
                        <input wire:model="name" name="role" type="text" class="form-control"
                            placeholder="Ej. Horario mañana">
                        <x-jet-input-error for="name" />
                    </div>

                    <div>
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="modal = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="saveTableTime"
                            @click="Livewire.on('save', () => {modal = false, success()})"
                            class="mr-1 btn btn-primary">Crear</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            function success() {
                Toastify({
                    node: $("#save")
                        .clone()
                        .removeClass("hidden")[0],
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    background: "white",
                    stopOnFocus: true,
                }).showToast();
            }

            Livewire.on('save', () => {
                success()
            })

            function message() {
                setTimeout(function() {
                    Livewire.emit('save')
                }, 200)
            }

            @if (session()->has('message'))
                message()
            @endif
        </script>

        <script>
            function deleteTime(id) {
                Swal.fire({
                    title: '¿Está seguro?',
                    text: "¿Desea eliminar la tabla?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: '¡No!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteTime', id)
                    }
                })
            }
        </script>
    @endpush
</div>
