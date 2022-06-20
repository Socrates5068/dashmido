@php
use App\Models\Consultation;
use App\Models\Staff;
use App\Models\Patient;
@endphp
@php
use App\Models\Person;
@endphp
<div x-data="{ newPatient: false, status: false }">
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Fichajes'])
    </div>

    <x-notification-message on="save">
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
                    <div class="mt-1 text-slate-500">El horario a sido agregado correctamente.</div>
                </div>
            </div>
        </div>
        <!-- END: Notification Content -->
    </x-notification-message>

    <h2 class="mt-10 mb-5 text-lg font-medium intro-y">
        Seguimiento del paciente
    </h2>
    <div class="grid grid-cols-3 gap-6 ">
        <div class="">
            <label for="patient" class="form-label">Buscar un paciente</label>
            <x-lwa::autocomplete name="patient-name" wire:model-text="name" wire:model-id="patientId"
                wire:model-results="patients" :options="[
                    'text' => 'name',
                    'allow-new' => 'false',
                ]" />
            <x-jet-input-error for="patientId" />
        </div>
        <div class="">
            <label for="patient" class="form-label">Acción</label> </br>
            <button wire:click="diagnostic" class="mb-2 mr-1 w-36 btn btn-primary">Nueva consulta</button>
        </div>
        <div class="">
            <label for="patient" class="form-label">Nuevo paciente</label> </br>
            <button @click="newPatient = true" class="mb-2 mr-1 w-36 btn btn-primary">Registrar un nuevo
                paciente</button>
        </div>
    </div>

    <h2 class="mt-10 mb-5 text-lg font-medium intro-y">
        Últimas consultas del médico
    </h2>
    <div class="intro-y">
        @if ($consultations->count())
            <!-- ====== Table Section Start -->
            <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
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
                                    Estado
                                </th>
                                <th class="whitespace-nowrap">
                                    Paciente
                                </th>
                                <th class="whitespace-nowrap">
                                    Diagnostico
                                </th>
                                {{-- <th class="whitespace-nowrap">
                                    Acciones
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $key => $consultation)
                                <tr>
                                    <td>
                                        {{ $consultation->id }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($consultation->created_at)) }}
                                    </td>
                                    <td>
                                        @if ($consultation->status == Consultation::FIRST)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-secondary">{{ $consultation->status }}</button>
                                        @elseif ($consultation->status == Consultation::SECOND)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-pending">{{ $consultation->status }}</button>
                                        @elseif ($consultation->status == Consultation::THIRD)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-success">{{ $consultation->status }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.history', Patient::find($consultation->patient_id)->person->id) }}">
                                            {{ Patient::find($consultation->patient_id)->person->name }}
                                            {{ Patient::find($consultation->patient_id)->person->f_last_name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $consultation->diagnostic }}
                                    </td>
                                    <td>
                                        {{-- <button
                                            wire:click="showPatient('{{ Patient::find($consultation->patient_id)->person->id }}')"
                                            class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Mostrar</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table Section End -->
            <nav class="hidden w-full mt-4 md:block">
                {{ $consultations->links() }}
            </nav>
            <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                {{ $consultations->links('pagination::tailwind') }}
            </nav>
        @else
            <div class="p-10">
                <div class="mb-2 alert alert-secondary show" role="alert">
                    <div class="flex items-center">
                        <div class="text-lg font-medium">Aún no hay consultas registradas.</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="mb-5">
        <h2 class="mt-10 text-lg font-medium intro-y">
            Fichaje del día
        </h2>
    </div>
    @if ($tickets->count())
        <div class="col-span-2 gap-4 mb-5">
            <div class="mt-6">
                <div class="mt-8 overflow-auto intro-y lg:overflow-visible sm:mt-0">
                    <table class="table table-report sm:mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">FECHA</th>
                                <th class="whitespace-nowrap">HORA</th>
                                <th class="whitespace-nowrap">PACIENTE</th>
                                <th class="whitespace-nowrap">ESTADO</th>
                                <th class="text-center whitespace-nowrap">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="intro-x">
                                    <td>
                                        <b class="font-medium whitespace-nowrap">{{ $ticket->date }} </b>
                                    </td>
                                    <td>
                                        <b class="font-medium whitespace-nowrap">{{ $ticket->time }} </b>
                                    </td>
                                    <td>
                                        @isset($ticket->patient_id)
                                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                                {{ Person::find($ticket->patient_id)->name }}
                                                {{ Person::find($ticket->patient_id)->f_last_name }}
                                                {{ Person::find($ticket->patient_id)->m_last_name }}
                                            </div>
                                        @else
                                            Ningún usuario registrado
                                        @endisset
                                    </td>
                                    <td>
                                        @if ($ticket->status == '0')
                                            <button class="h-5 btn btn-rounded btn-secondary-soft w-24 text-xs">Sin
                                                reservar</button>
                                        @elseif($ticket->status == '1')
                                            <button
                                                class="h-5 btn btn-rounded btn-pending-soft w-24 text-xs">Pendiente</button>
                                        @elseif($ticket->status == '2')
                                            <button class="h-5 btn btn-rounded btn-warning-soft w-24 text-xs">En
                                                atención</button>
                                        @elseif($ticket->status == '3')
                                            <button
                                                class="h-5 btn btn-rounded btn-success-soft w-24 text-xs">Atendido</button>
                                        @endif
                                    </td>
                                    <td class="w-52 table-report__action">
                                        @if (!is_null($ticket->patient_id))
                                            <a class="font-semibold text-blue-600 underline"
                                                href="{{ route('admin.history', $ticket->patient_id) }}">Ver
                                                paciente</a>
                                            <button @click="$wire.set('statusId', {{ $ticket->id }}), status = true"
                                                class="h-5 ml-3 btn btn-sm btn-primary w-30">ESTADO</button>
                                        @else
                                            <a class="font-semibold text-blue-600 underline" disabled">Ver
                                                paciente</a>
                                            <button disabled
                                                class="h-5 ml-3 btn btn-sm btn-primary w-30">ESTADO</button>
                                        @endif
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
    @else
        <div wire class="flex items-center w-full max-w-lg mx-auto mt-6 alert alert-dark show" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <p class="ml-3"> No hay fichas reservadas </p>
        </div>
    @endif

    <!-- BEGIN: New Patient -->
    <div x-show="newPatient" :class="{ 'show': newPatient, '': !newPatient }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="newPatient = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="mb-4 text-slate-500">
                        Los campos marcados con un <span class="font-bold">(*)</span> son obligatorios.
                    </div>
                    <div>
                        <label for="name" class="form-label">*Nombres</label>
                        <input wire:model="newPatient.name" id="name" type="text" class="form-control"
                            placeholder="Ej. Juan Ambrosio">
                        <x-jet-input-error for="newPatient.name" />
                    </div>
                    <div class="gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="f_last_name" class="form-label">*Apellido paterno</label>
                            <input wire:model="newPatient.f_last_name" id="f_last_name" type="text"
                                class="form-control" placeholder="Ej. Aramayo">
                            <x-jet-input-error for="newPatient.f_last_name" />
                        </div>
                        <div class="mt-3">
                            <label for="m_last_name" class="form-label">*Apellido materno</label>
                            <input wire:model="newPatient.m_last_name" id="m_last_name" type="text"
                                class="form-control" placeholder="Ej. Martinez">
                            <x-jet-input-error for="newPatient.m_last_name" />
                        </div>
                    </div>
                    <div class="mt-3 gap-4 md:grid md:grid-cols-2">
                        <div class="mt-3">
                            <label for="m_last_name" class="form-label">*Dirección</label>
                            <input wire:model="newPatient.address" id="m_last_name" type="text"
                                class="form-control" placeholder="Calle xx Nº 65">
                            <x-jet-input-error for="newPatient.address" />
                        </div>
                        <div>
                            <label for="sex" class="form-label">*Sexo</label>
                            <select wire:model="newPatient.sex" data-placeholder="Seleccione un sexo"
                                class="w-full form-control" id="sex">
                                <option value="">Seleccione un sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            <x-jet-input-error for="newPatient.sex" />
                        </div>
                    </div>
                    <button class="mt-10 mr-2 shadow-md btn btn-danger"
                        @click="newPatient = false, Livewire.emit('resetVariables')">Cerrar</button>

                    <button wire:click="savePatient" @click="Livewire.on('save', () => {newPatient = false; } )"
                        class="mr-2 shadow-md btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: New Patient -->

    <!-- BEGIN: Status -->
    <div x-show="status" :class="{ 'show': status, '': !status }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="status = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="mt-3">
                        <div>
                            <label for="sex" class="form-label">Seleccione un estado</label>
                            <select wire:model="status" data-placeholder="Seleccione un estado"
                                class="w-full form-control" id="sex">
                                <option value="" selected>Seleccione un estado</option>
                                <option value="1">Pendiente</option>
                                <option value="2">En atención</option>
                                <option value="3">Atendido</option>
                            </select>
                            <x-jet-input-error for="status" />
                        </div>
                    </div>
                    <button class="mt-10 mr-2 shadow-md btn btn-danger"
                        @click="status = false, Livewire.emit('resetVariables')">Cerrar</button>

                    <button wire:click="saveStatus" @click="Livewire.on('save', () => {status = false; } )"
                        class="mr-2 shadow-md btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Status -->
</div>
