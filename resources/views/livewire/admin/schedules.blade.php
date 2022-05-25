@php
use App\Models\Department;
use App\Models\TimeTable;
use App\Models\Staff;
@endphp
<div>
    <div wire:ignore class="">
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

    <h2 class="text-lg font-medium intro-y mt-4">
        Horarios para fichaje
    </h2>

    <div class="relative p-8 mt-8 bg-white rounded-lg shadow-lg">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-3">
                <label>Horario</label>
                <div class="mt-2">
                    <select wire:model='time' data-placeholder="Select your favorite actors"
                        class="form-control w-full">
                        <option value="" selected>Seleccionar horario</option>
                        @foreach ($times as $time)
                            <option value="{{ $time->id }}">{{ $time->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="time" />
                </div>
            </div>

            <div class="col-span-3">
                <label>Departamento</label>
                <div class="mt-2">
                    <select wire:model='department' data-placeholder="Select your favorite actors"
                        class="form-control w-full">
                        <option value="" selected>Seleccionar departmento</option>
                        @foreach ($departments as $department)
                            @if ($department->name !== 'Administración' && $department->name !== 'Enfermería')
                                <option value="{{ $department->id }}">{{ $department->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <x-jet-input-error for="department" />
                </div>
            </div>

            <div class="col-span-3">
                <label>Personal</label>
                <div class="mt-2">
                    <select wire:model='personal' data-placeholder="Select your favorite actors"
                        class="form-control w-full">
                        <option value="" selected>Seleccionar médico</option>
                        @foreach ($staff as $staf)
                            @if ($staf->person->id !== 1 && $staf->person->user->getRoleNames()->first() !== 'Enfermera')
                                <option value="{{ $staf->id }}">{{ $staf->person->name }}
                                    ({{ $staf->department->name }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <x-jet-input-error for="personal" />
                </div>
            </div>

            <div class="col-span-3">
                <label class="">Acciones</label>
                <div class="flex justify-center mt-2">
                    @isset($aux)
                        <button wire:click='update' class="w-24 mb-2 mr-1 btn btn-warning">Actualizar</button>
                        <button wire:click='resetVariables' class="w-24 mb-2 mr-1 btn btn-danger">Cancelar</button>
                    @else
                        <button wire:click='save' class="w-24 mb-2 mr-1 btn btn-primary">Agregar</button>
                        <button wire:click='resetVariables' class="w-24 mb-2 mr-1 btn btn-danger">Cancelar</button>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <div class="relative p-8 mt-8 bg-white rounded-lg shadow-lg">
        <div class="col-span-12 overflow-auto intro-y lg:overflow-visible">
            <table class="table -mt-2 table-report">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">ID</th>
                        <th class="text-center whitespace-nowrap">HORARIO</th>
                        <th class="text-center whitespace-nowrap">DEPARTAMENTO</th>
                        <th class="text-center whitespace-nowrap">MÉDICO</th>
                        <th class="text-center whitespace-nowrap">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr class="intro-x">
                            <td>
                                <a href="" class="font-medium whitespace-nowrap">{{ $schedule->id }}</a>
                            </td>
                            <td>
                                <a href=""
                                    class="font-medium whitespace-nowrap">{{ TimeTable::find($schedule->timeTable_id)->name }}</a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Photography</div>
                            </td>
                            <td class="text-center">{{ Department::find($schedule->department_id)->name }}</td>
                            <td class="w-40">
                                <a href=""
                                    class="font-medium whitespace-nowrap">{{ Staff::find($schedule->doctor_id)->person->name }}
                                    {{ Staff::find($schedule->doctor_id)->person->f_last_name }}</a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{ Staff::find($schedule->doctor_id)->department->name }}</div>
                            </td>
                            <td class="w-56 table-report__action">
                                <div class="flex items-center justify-center">
                                    <p wire:click="edit({{ $schedule->id }})"
                                        class="flex items-center mr-3 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="check-square"
                                            data-lucide="check-square" class="w-4 h-4 mr-1 lucide lucide-check-square">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg> Edit
                                    </p>
                                    <p wire:click="delete({{ $schedule->id }})"
                                        class="flex items-center text-danger cursor-pointer" data-tw-toggle="modal"
                                        data-tw-target="#delete-confirmation-modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="trash-2"
                                            data-lucide="trash-2" class="w-4 h-4 mr-1 lucide lucide-trash-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg> Delete
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
