<div>
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Fichajes'])
    </div>

    <div class="bg-white shadow-lg rounded-lg p-8 mt-8">
        <h2 class="intro-y text-lg font-medium">
            Horario mañana
        </h2>

        <div class="intro-y grid grid-cols-2 gap-6 mt-5">
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
                        @endphp
                        @for ($i = 0; $i < count($morning); $i = $i + 2)
                            <tr>
                                <td>{{ $j }}</td>
                                <td>{{ $morning[$i] }}</td>
                                <td>{{ $morning[$i + 1] }}</td>
                                @php
                                    $j++;
                                @endphp
                                <td>
                                    <div class="flex">
                                        <svg wire:click="editMorning({{ $i }})"
                                            class="cursor-pointer h-6 w-6 text-green-600 mr-1 ml-1"
                                            xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <svg class="cursor-pointer h-6 w-6 text-red-600"
                                            xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div>
                <x-jet-validation-errors class="mt-4 mb-4" />
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-6">
                        <label for="regular-form-1" class="form-label">Inicio</label>
                        <input wire:model="mtime.start" type="time" class="form-control" placeholder="Input inline 1"
                            aria-label="default input inline 1">
                    </div>
                    <div class="col-span-6">
                        <label for="regular-form-1" class="form-label">Fin</label>
                        <input wire:model="mtime.end" type="time" class="form-control" placeholder="Input inline 2"
                            aria-label="default input inline 2">
                    </div>
                </div>
                @if ($mtime['aux'])
                    <button wire:click="morning" class="btn btn-warning mt-5">Actualizar</button>
                    <button wire:click="resetVariables" class="btn btn-danger mt-5">cancelar</button>
                @else
                    <button wire:click="morning" class="btn btn-primary mt-5">Agregar</button>
                @endif
            </div>
        </div>
    </div>



    <hr class="mt-8 mb-8">

    <h2 class="intro-y text-lg font-medium mt-10">
        Horario tarde
    </h2>

    <div class="grid grid-cols-2 gap-6 mt-5">
        <div class="">
            <div>
                <label for="regular-form-1" class="form-label">Input Text</label>
                <input id="regular-form-1" type="text" class="form-control" placeholder="Input text">
            </div>
            <button class="btn btn-primary mt-5">Login</button>
        </div>
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">First Name</th>
                        <th class="whitespace-nowrap">Last Name</th>
                        <th class="whitespace-nowrap">Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Angelina</td>
                        <td>Jolie</td>
                        <td>@angelinajolie</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Brad</td>
                        <td>Pitt</td>
                        <td>@bradpitt</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Charlie</td>
                        <td>Hunnam</td>
                        <td>@charliehunnam</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <hr class="mt-8 mb-8">

    <h2 class="intro-y text-lg font-medium mt-10">
        Horario noche
    </h2>

    <div class="grid grid-cols-2 gap-6 mt-5">
        <div class="">
            <table class="table">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">First Name</th>
                        <th class="whitespace-nowrap">Last Name</th>
                        <th class="whitespace-nowrap">Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Angelina</td>
                        <td>Jolie</td>
                        <td>@angelinajolie</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Brad</td>
                        <td>Pitt</td>
                        <td>@bradpitt</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Charlie</td>
                        <td>Hunnam</td>
                        <td>@charliehunnam</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="">
            <div>
                <label for="regular-form-1" class="form-label">Input Text</label>
                <input id="regular-form-1" type="text" class="form-control" placeholder="Input text">
            </div>
            <button class="btn btn-primary mt-5">Login</button>
        </div>
    </div>

</div>
