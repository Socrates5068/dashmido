@php
use App\Models\Department;
use App\Models\TimeTable;
use App\Models\Staff;
@endphp
<div x-data>
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

    <h2 class="mt-4 text-lg font-medium intro-y">
        Horarios para fichaje
    </h2>

    <div class="relative p-8 mt-8 bg-white rounded-lg shadow-lg">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-2">
                <label>Horario</label>
                <div class="mt-2">
                    <select wire:model='time' data-placeholder="Select your favorite actors"
                        class="w-full form-control">
                        <option value="" selected>Seleccionar horario</option>
                        @foreach ($times as $time)
                            <option value="{{ $time->id }}">{{ $time->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="time" />
                </div>
            </div>

            <div class="col-span-3">
                <label>Especialidad</label>
                <div class="mt-2">
                    <select wire:model='department' onchange="setDepartment()" id="departments"
                        data-placeholder="Select your favorite actors" class="w-full form-control">
                        <option value="" selected>Seleccionar especialidad</option>
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
                    @if (!is_null($selectedDepartment))
                        <select wire:model='personal' id="personal"
                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                            <option value="" selected>Selecciona un médico</option>
                            @foreach ($selectedDepartment->staff as $staf)
                                @if ($staf->person->id !== 1 && $staf->person->user->getRoleNames()->first() !== 'Enfermera')
                                    <option value="{{ $staf->id }}">{{ $staf->person->name }}
                                        ({{ $staf->department->name }})
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <x-jet-input-error for="personal" />
                    @else
                        <select disabled
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            name="state">
                            <option value="" disabled selected>Selecciona un medico</option>
                        </select>
                    @endif
                </div>
            </div>

            <div class="col-span-1">
                <label class="">Precio</label>
                <input wire:model="price" class="mt-2 form-control" type="text">
                <x-jet-input-error for="price" />
            </div>

            <div class="col-span-3">
                <label class="">Acciones</label>
                <div class="flex justify-center mt-2">
                    @isset($aux)
                        <button wire:click='update' class="mb-2 mr-1 w-18 btn btn-warning">Actualizar</button>
                        <button wire:click='resetVariables' class="mb-2 mr-1 w-18 btn btn-danger">Cancelar</button>
                    @else
                        <button wire:click='save' class="mb-2 mr-1 w-18 btn btn-primary">Agregar</button>
                        <button wire:click='resetVariables' class="mb-2 mr-1 w-18 btn btn-danger">Cancelar</button>
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
                        <th class="text-center whitespace-nowrap">ESPECIALIDAD</th>
                        <th class="text-center whitespace-nowrap">MÉDICO</th>
                        <th class="text-center whitespace-nowrap">PRECIO</th>
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
                                <a href="{{ route('admin.table') }}"
                                    class="font-medium whitespace-nowrap">{{ TimeTable::find($schedule->time_table_id)->name }}</a>
                                {{-- <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">Photography</div> --}}
                            </td>
                            <td class="font-medium text-center">
                                {{ Department::find($schedule->department_id)->name }}</td>
                            <td class="w-40">
                                <a href=""
                                    class="font-medium whitespace-nowrap">{{ Staff::find($schedule->staff_id)->person->name }}
                                    {{ Staff::find($schedule->staff_id)->person->f_last_name }}</a>
                                <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">
                                    {{-- {{ Staff::find($schedule->staff_id)->department->name }}</div> --}}
                            </td>
                            <td class="w-20">
                                {{ $schedule->price }}
                            </td>
                            <td class="w-56 table-report__action">
                                <div class="flex items-center justify-center">
                                    <p wire:click="edit({{ $schedule->id }})"
                                        class="flex items-center mr-3 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" icon-name="check-square"
                                            data-lucide="check-square"
                                            class="w-4 h-4 mr-1 lucide lucide-check-square">
                                            <polyline points="9 11 12 14 22 4"></polyline>
                                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                                        </svg> Edit
                                    </p>
                                    <p @click="deleteSchedule({{ $schedule->id }})"
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
    @push('scripts')
        <script>
            function setDepartment() {
                var department = document.getElementById('departments');
                var selectedDepartment = department.options[department.selectedIndex].value;
                // console.log(selectedDepartment)
                Livewire.emit('selectDepartment', selectedDepartment)
            }
        </script>

        <script>
            function deleteSchedule(id) {
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
                        Livewire.emit('delete', id)
                    }
                })
            }
        </script>
    @endpush
</div>
