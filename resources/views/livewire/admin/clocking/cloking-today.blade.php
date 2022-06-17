@php
use App\Models\Department;
use App\Models\Person;
use App\Models\Staff;
@endphp
<div x-data="{ modal: false }">
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/tailwind.output.css') }}" />
    @endpush
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Pacientes'])
    </div>

    <div class="mb-5 ">
        @if ($tickets->count())
            @php
                $title = $tickets->first()->department_id;
            @endphp
        @endif
        <h2 class="mt-10 text-lg font-medium intro-y">
            Fichajes
        </h2>
        <div class="mt-5">
            @if ($tickets->count())
                @foreach ($departments as $department)
                    @if ($department->name !== 'Administración' && $department->name !== 'Enfermería')
                        <button wire:click="tickets('{{ $department->id }}')"
                            class="{{ $tickets->first()->department_id == $department->id ? 'btn-success' : 'btn-primary' }} btn w-40 mr-1 mb-2">
                            {{ $department->name }}
                        </button>
                    @endif
                @endforeach
            @else
                @foreach ($departments as $department)
                    @if ($department->name !== 'Administración' && $department->name !== 'Enfermería')
                        <button wire:click="tickets('{{ $department->id }}')" class="w-40 mb-2 mr-1 btn btn-primary">
                            {{ $department->name }}
                        </button>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    @if ($tickets->count())
        <!-- ====== Table Section Start -->
        <div class="relative p-8 mt-8 bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-bold intro-y">
                {{ Department::find($title)->name }}
            </h2>
            <div class="intro-y">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                Fecha
                            </th>
                            <th class="whitespace-nowrap">
                                Médico
                            </th>
                            <th class="whitespace-nowrap">
                                Hora
                            </th>
                            <th class="whitespace-nowrap">
                                Paciente
                            </th>
                            <th class="whitespace-nowrap">
                                Estado
                            </th>
                            <th class="whitespace-nowrap">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>
                                    {{ $ticket->date }}
                                </td>
                                <td>
                                    {{ Staff::find($ticket->doctor_id)->person->name }}
                                    {{ Staff::find($ticket->doctor_id)->person->f_last_name }}
                                </td>
                                <td>
                                    {{ $ticket->time }}
                                </td>
                                <td>
                                    @isset($ticket->patient_id)
                                        {{ Person::find($ticket->patient_id)->name }}
                                        {{ Person::find($ticket->patient_id)->f_last_name }}
                                        {{ Person::find($ticket->patient_id)->m_last_name }}
                                    @endisset
                                </td>
                                @if ($ticket->status == '0')
                                    <td>
                                        <span
                                            class="inline-block px-3 py-1 m-2 text-sm font-semibold text-white rounded-full bg-success">
                                            Sin reservar
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span
                                            class="inline-block px-3 py-1 m-2 text-sm font-semibold text-white rounded-full bg-danger">
                                            Reservado
                                        </span>
                                    </td>
                                @endif
                                @if ($ticket->status == '0')
                                    <td>
                                        <span @click="modal = true, $wire.set('aux', {{ $ticket->id }})"
                                            class="inline-block px-2 py-1 m-2 text-sm font-semibold text-white rounded cursor-pointer bg-primary">
                                            Reservar
                                        </span>
                                    </td>
                                @else
                                    <td>
                                        <span
                                            class="inline-block px-2 py-1 m-2 text-sm font-semibold text-white bg-gray-600 rounded">
                                            Reservar
                                        </span>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- ====== Table Section End -->

        <div x-show="modal" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0  transform translate-y-1/2"
                @click.away="modal = false, Livewire.emit('resetVariables')"
                @keydown.escape="modal = false, Livewire.emit('resetVariables')" {{-- Esto hace que el modal no se abra ni bien se entra en la pagina --}}
                :class="{ 'block': modal, 'hidden': !modal }"
                class="hidden w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog" id="modal">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                        aria-label="close" @click="modal = false, Livewire.emit('resetVariables')">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                            aria-hidden="true">
                            <path
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" fill-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                </header>
                <!-- Modal body -->
                <div class="mb-6">
                    <label for="patient-name" class="form-label">Seleccione un paciente</label>
                    <x-lwa::autocomplete name="patient-name" wire:model-text="name" wire:model-id="patientId"
                        wire:model-results="patients" :options="[
                            'text' => 'name',
                            'allow-new' => 'false',
                        ]" />
                    <x-jet-input-error for="patientId" />
                </div>
                <footer
                    class="flex flex-col items-center justify-end px-6 py-3 mt-40 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                    <div>
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="modal = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="updateTicket" @click="Livewire.on('save', () => {modal = false, success()})"
                            class="mr-1 btn btn-primary">Reservar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </footer>
            </div>
        </div>
    @else
        <div class="p-10">
            <div class="mb-2 alert alert-secondary show" role="alert">
                <div class="flex items-center">
                    <div class="text-lg font-medium">No existen horarios registrados para esta Especialidad.</div>
                </div>
                <div class="mt-3">
                    <p>
                        Para registrar un horario diríjase a <a class="font-semibold text-blue-600 underline"
                            href="{{ route('admin.table') }}"> Tabla de horarios. </a> </p>
                    <p> Para agregar asignar un horario a un médico y agregarlo a la tabla de fichaje diríjase a <a
                            class="font-semibold text-blue-600 underline" href="{{ route('admin.schedule') }}">
                            Horarios para fichaje. </a></p>
                </div>
            </div>
        </div>
    @endif
</div>
