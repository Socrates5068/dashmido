@php
    use App\Models\Person;
@endphp
<div>
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Fichajes'])
    </div>

    <div class="mb-5">
        <h2 class="intro-y text-lg font-medium mt-10">
            Fichajes
        </h2>
        {{-- <div class="mt-5">
            @foreach ($departments as $department)
                <button wire:click="tickets('{{ $department->name }}')" class="btn btn-primary w-32 inline-block mr-1 mb-2">{{$department->name}}</button>
            @endforeach
        </div> --}}
    </div>
    @if($tickets->count())
        <div class="mb-5 col-span-2 md:grid md:grid-cols-2 gap-4">
            <div class="mt-6">
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                    <table class="table table-report sm:mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">HORA</th>
                                <th class="whitespace-nowrap">PACIENTE</th>
                                <th class="text-center whitespace-nowrap">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="intro-x">
                                    <td>
                                        <b class="font-medium whitespace-nowrap">{{ $ticket->time }} </b>
                                    </td>
                                    <td>
                                        {{-- <b class="font-medium whitespace-nowrap">{{ substr($depa->description, 0, 20) . '...' }}</b> --}}
                                        @if ($ticket->patient_id)
                                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                                {{ Person::find($ticket->patient_id)->name }}
                                                {{ Person::find($ticket->patient_id)->f_last_name }}
                                                {{ Person::find($ticket->patient_id)->m_last_name }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="table-report__action w-56">
                                        Ver paciente
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
    @else
        <div wire class="flex items-center alert alert-dark show mt-6 w-full max-w-lg mx-auto" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg> <p class="ml-3"> No hay fichas reservadas </p>
        </div>
    @endif
</div>
