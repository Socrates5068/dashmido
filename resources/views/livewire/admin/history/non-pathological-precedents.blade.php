<div>
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

    <div class="px-5 pt-5 mt-5 intro-y box">
        <div class="flex justify-between">
            <h2 class="mb-4 text-lg font-bold intro-y">
                Antecedentes personales no patológicos
            </h2>
            <div wire:click="save">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    icon-name="save" data-lucide="save" class="cursor-pointer lucide lucide-save block mx-auto">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-3">
                <label class="form-label">Lugar de origen</label>
                <select wire:model="nonPathological.lugar_origen" class="form-select" name="" id="">
                    <option value="" selected>Selecciona una opción</option>
                    <option value="Beni">Beni</option>
                    <option value="Chuquisaca">Chuquisaca</option>
                    <option value="Cochabamba">Cochabamba</option>
                    <option value="La Paz">La Paz</option>
                    <option value="Oruro">Oruro</option>
                    <option value="Pando">Pando</option>
                    <option value="Potosí">Potosí</option>
                    <option value="Santa Cruz">Santa Cruz</option>
                    <option value="Tarija">Tarija</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
            <div class="col-span-3">
                <label class="form-label">Estado civil</label>
                <select wire:model="nonPathological.estado_civil" class="form-select" name="" id="">
                    <option value="" selected>Selecciona una opción</option>
                    <option value="Casado">Casado</option>
                    <option value="Divordiado">Divordiado</option>
                    <option value="Soltero">Soltero</option>
                    <option value="Viudo">Viudo</option>
                </select>
            </div>
            <div class="col-span-3">
                <label for="regular-form-1" class="form-label">Religión</label>
                <input wire:model="nonPathological.religion" class="form-control" type="text">
            </div>
            <div class="col-span-3">
                <label for="regular-form-1" class="form-label">Escolaridad</label>
                <select wire:model="nonPathological.escolaridad" class="form-select" name="" id="">
                    <option value="" selected>Selecciona una opción</option>
                    <option value="Estudiante">Estudiante</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Masterado">Masterado</option>
                    <option value="Doctorado">Doctorado</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-6">
            <div class="col-span-3">
                <label for="regular-form-1" class="form-label">Nacionalidad</label>
                <input wire:model="nonPathological.nacionalidad" class="form-control" type="text">
            </div>
            <div class="col-span-3">
                <label for="regular-form-1" class="form-label">Lugar de residencia</label>
                <input wire:model="nonPathological.lugar_residencia" class="form-control" type="text">
            </div>
            <div class="col-span-3">
                <label for="regular-form-1" class="form-label">Ocupación</label>
                <input wire:model="nonPathological.ocupacion" class="form-control" type="text">
            </div>
            <div class="col-span-3">
                <label for="regular-form-1" class="form-label">Grupo Sanguíneo</label>
                <select wire:model="nonPathological.sanguineo" class="form-select" name="" id="">
                    <option value="" selected>Selecciona una opción</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-6">
            <div class="col-span-4">
                <label class="form-label">Higiene adecuada</label>
                <div>
                    <button wire:click="higiene('0')"
                        class="{{ $nonPathologicalPrecedent->higiene == '0' ? 'btn-success' : 'btn-secondary' }} btn mr-1 mb-2">
                        Sí
                    </button>
                    <button wire:click="higiene('1')"
                        class="{{ $nonPathologicalPrecedent->higiene == '1' ? 'btn-danger' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        No
                    </button>
                </div>
            </div>
            <div class="col-span-4">
                <label class="form-label">Alimentación adecuada</label>
                <div>
                    <button wire:click="alimentacion('0')"
                        class="{{ $nonPathologicalPrecedent->alimentacion == '0' ? 'btn-success' : 'btn-secondary' }} btn mr-1 mb-2">
                        Sí
                    </button>
                    <button wire:click="alimentacion('1')"
                        class="{{ $nonPathologicalPrecedent->alimentacion == '1' ? 'btn-danger' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        No
                    </button>
                </div>
            </div>
            <div class="col-span-4">
                <label class="form-label">Actividad física</label>
                <div>
                    <button wire:click="actividad_fisica('0')"
                        class="{{ $nonPathologicalPrecedent->actividad_fisica == '0' ? 'btn-success' : 'btn-secondary' }} btn mr-1 mb-2">
                        Sí
                    </button>
                    <button wire:click="actividad_fisica('1')"
                        class="{{ $nonPathologicalPrecedent->actividad_fisica == '1' ? 'btn-danger' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        No
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-6">
            <div class="col-span-4">
                <label class="form-label">Alcoholismo</label>
                <div>
                    <button wire:click="alcoholismo('0')"
                        class="{{ $nonPathologicalPrecedent->alcoholismo == '0' ? 'btn-success' : 'btn-secondary' }} btn mr-1 mb-2">
                        Sí
                    </button>
                    <button wire:click="alcoholismo('1')"
                        class="{{ $nonPathologicalPrecedent->alcoholismo == '1' ? 'btn-danger' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        No
                    </button>
                    <button wire:click="alcoholismo('2')"
                        class="{{ $nonPathologicalPrecedent->alcoholismo == '2' ? 'btn-success' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        Ocasional
                    </button>
                </div>
            </div>
            <div class="col-span-4">
                <label class="form-label">Tabaquismo</label>
                <div>
                    <button wire:click="tabaquismo('0')"
                        class="{{ $nonPathologicalPrecedent->tabaquismo == '0' ? 'btn-success' : 'btn-secondary' }} btn mr-1 mb-2">
                        Sí
                    </button>
                    <button wire:click="tabaquismo('1')"
                        class="{{ $nonPathologicalPrecedent->tabaquismo == '1' ? 'btn-danger' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        No
                    </button>
                    <button wire:click="tabaquismo('2')"
                        class="{{ $nonPathologicalPrecedent->tabaquismo == '2' ? 'btn-success' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        Ocasional
                    </button>
                </div>
            </div>
            <div class="col-span-4 mb-5">
                <label class="form-label">Drogas</label>
                <div>
                    <button wire:click="drogas('0')"
                        class="{{ $nonPathologicalPrecedent->drogas == '0' ? 'btn-success' : 'btn-secondary' }} btn mr-1 mb-2">
                        Sí
                    </button>
                    <button wire:click="drogas('1')"
                        class="{{ $nonPathologicalPrecedent->drogas == '1' ? 'btn-danger' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        No
                    </button>
                    <button wire:click="drogas('2')"
                        class="{{ $nonPathologicalPrecedent->drogas == '2' ? 'btn-success' : 'btn-secondary' }} btn btn-secondary mr-1 mb-2">
                        Ocasional
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- @push('scripts')
        <script>
            setInterval(automaticSave, 30000);

            function automaticSave() {
                Livewire.emit('save')
            }
        </script>
    @endpush --}}
</div>
