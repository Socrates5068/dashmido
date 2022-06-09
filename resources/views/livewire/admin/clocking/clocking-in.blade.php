@php
use App\Models\Consultation;
use App\Models\Staff;
use App\Models\Patient;
@endphp
@php
use App\Models\Person;
@endphp
<div>
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Fichajes'])
    </div>

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

    <div class="mb-5">
        <h2 class="mt-10 text-lg font-medium intro-y">
            Fichaje del día
        </h2>
        {{-- <div class="mt-5">
            @foreach ($departments as $department)
                <button wire:click="tickets('{{ $department->name }}')" class="inline-block w-32 mb-2 mr-1 btn btn-primary">{{$department->name}}</button>
            @endforeach
        </div> --}}
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
                                        {{-- <b class="font-medium whitespace-nowrap">{{ substr($depa->description, 0, 20) . '...' }}</b> --}}
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
                                    <td class="w-56 table-report__action">
                                        @if (!is_null($ticket->patient_id))
                                            <a href="{{ route('admin.history', $ticket->patient_id) }}">Ver
                                                paciente</a>
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
</div>
