<div x-data="{ attention: false, editAttention: false }">
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Enfermería'])
    </div>

    <x-notification-message on="saved">
        <!-- BEGIN: Notification Content -->
        <div id="save" class="flex toastify-content">
            <div class="relative flex w-full max-w-lg mx-auto my-auto bg-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-4 mr-4">
                    <div class="font-medium">¡Registro exitoso!</div>
                    <div class="mt-1 text-slate-500">El registro a sido agregado correctamente.</div>
                </div>
            </div>
        </div>
        <!-- END: Notification Content -->
    </x-notification-message>

    <div class="grid grid-cols-3 gap-6 mt-5">
        <div class="">
            <a href="{{ route('admin.patients') }}" class="mb-2 mr-1 w-36 btn btn-primary">Registrar paciente</a>
        </div>
        <div class="">
            <button @click="attention = true" class="mb-2 mr-1 w-36 btn btn-primary">Nueva atención</button>
        </div>
        <div class="">
        </div>
    </div>

    <div class="intro-y">
        @if ($attentions->count())
            <!-- ====== Table Section Start -->
            <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-lg font-bold intro-y">
                    Atenciones
                </h2>
                <div class="intro-y">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">
                                    Nº
                                </th>
                                <th class="whitespace-nowrap">
                                    Fecha
                                </th>
                                <th class="whitespace-nowrap">
                                    Descripción
                                </th>
                                <th class="whitespace-nowrap">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attentions as $key => $attention)
                                <tr>
                                    <td>
                                        {{ $attention->id }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($attention->created_at)) }}
                                    </td>
                                    <td>
                                        {{ substr($attention->description, 0, 10)}}
                                    </td>
                                    <td>
                                        <button wire:click="edit('{{ $attention->id }}')"
                                            @click="editAttention = true"
                                            class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Editar</button>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table Section End -->
            <nav class="hidden w-full mt-4 md:block">
                {{ $attentions->links() }}
            </nav>
            <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                {{ $attentions->links('pagination::tailwind') }}
            </nav>
        @else
            <div class="p-10">
                <div class="mb-2 alert alert-secondary show" role="alert">
                    <div class="flex items-center">
                        <div class="text-lg font-medium">Este paciente aún no tiene consultas registradas.</div>
                    </div>
                    <div class="mt-3">
                        <p>
                            Para registrar uan nueva consultas haga clic en el botón <a
                                class="font-semibold text-blue-600 underline" href="{{ route('admin.patients') }}">
                                +Nueva
                                consulta </a> </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- BEGIN: Modal create attention -->
    <div x-show="attention" :class="{'show':attention, '': !attention}" class="modal-personal" tabindex="-1" aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="attention = false">
                <div class="p-10 text-center modal-body">
                    <div>
                        <label>Paciente</label>
                        <div class="mt-2">
                            <select wire:model="patient_id" name="" id="">
                                <option value="">Seleccion un paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->person->name . ' ' . $patient->f_last_name . ' ' . $patient->m_last_name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="patient_id" />
                        </div>
                    </div>
                    <div class="mt-5">
                        <label>Descripción</label>
                        <div>
                            <textarea wire:model="description" class="w-full h-40"></textarea>
                            <x-jet-input-error for="description" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="attention = false">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="save"
                            @click="Livewire.on('saved', () => { attention = false; } )"
                            class="mr-1 btn btn-primary">Guardar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal create attention -->

    <!-- BEGIN: Modal edit attention -->
    <div x-show="editAttention" :class="{'show':editAttention, '': !editAttention}" class="modal-personal" tabindex="-1" aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="editAttention = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div>
                        <label>Paciente</label>
                        <div class="mt-2">
                            <select wire:model="patient_id" name="" id="">
                                <option value="">Seleccion un paciente</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->person->name . ' ' . $patient->f_last_name . ' ' . $patient->m_last_name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="patient_id" />
                        </div>
                    </div>
                    <div class="mt-5">
                        <label>Descripción</label>
                        <div>
                            <textarea wire:model="description" class="w-full h-40"></textarea>
                            <x-jet-input-error for="description" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="editAttention = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="update('{{ $aux }}')"
                            @click="Livewire.on('saved', () => { editAttention = false; } )"
                            class="mr-1 btn btn-primary">Actualizar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Modal edit attention -->
</div>
