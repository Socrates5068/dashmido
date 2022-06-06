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
    
    <!-- ====== Table Section Start -->
    <div class="relative p-8 mt-8 bg-white rounded-lg shadow-lg">
        <h2 class="mb-4 text-lg font-bold intro-y">
            Antecedentes heredofamiliares
        </h2>
        <div class="intro-y">
            <table class="table">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">
                            Enfermedad
                        </th>
                        <th class="whitespace-nowrap">
                            Abuelos
                        </th>
                        <th class="whitespace-nowrap">
                            Padre
                        </th>
                        <th class="whitespace-nowrap">
                            Madre
                        </th>
                        <th class="whitespace-nowrap">
                            Hermanos
                        </th>
                        <th class="whitespace-nowrap">
                            Otros
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($precedents as $key => $precedent)
                        <tr>
                            <td>
                                {{ $key }}
                            </td>
                            @foreach ($precedent as $index => $item)
                                <td>
                                    <input wire:model='precedents.{{ $key }}.{{ $index }}'
                                        wire:click="save('{{ $key }}', '{{ $index }}')"
                                        class="form-check-input" type="checkbox">
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- ====== Table Section End -->

    <div class="px-5 pt-5 mt-5 intro-y box">
        <h2 class="mb-4 text-lg font-bold intro-y">
            Antecedentes personales patológicos
        </h2>
        <div class="grid grid-cols-12 gap-6">
            <div class=" col-span-6">
                <div class="flex justify-between">
                    <div>
                        <label for="regular-form-1" class="form-label">Eruptivos: (dermatitis, rash)</label>
                    </div>
                    <div>
                        <span wire:click="eruptivos" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->eruptivos) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->eruptivos))
                    <textarea wire:model='personal.eruptivos' class="w-full" rows="4"></textarea>
                @endif

                <div class="flex justify-between mt-6">
                    <div>
                        <label for="regular-form-1" class="form-label">Transfusionales: ¿Cuantos paquetes?</label>
                    </div>
                    <div>
                        <span wire:click="transfusionales" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->transfusionales) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->transfusionales))
                    <textarea wire:model='personal.transfusionales' class="w-full" rows="4"></textarea>
                @endif

                <div class="flex justify-between mt-6">
                    <div>
                        <label for="regular-form-1" class="form-label">Infecciosos: (Salmonelosis, chinkungunya, tifoidea)</label>
                    </div>
                    <div>
                        <span wire:click="infecciosos" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->infecciosos) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->infecciosos))
                    <textarea wire:model='personal.infecciosos' class="w-full" rows="4"></textarea>
                @endif

                <div class="flex justify-between mt-6">
                    <div>
                        <label for="regular-form-1" class="form-label">Alergicos: (lidocaina, penicilinas, ketorolaco)</label>
                    </div>
                    <div>
                        <span wire:click="alergicos" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->alergicos) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->alergicos))
                    <textarea wire:model='personal.alergicos' class="w-full" rows="4"></textarea>
                @endif
            </div>

            <div class="col-span-6">
                <div class="flex justify-between">
                    <div>
                        <label for="regular-form-1" class="form-label">Eruptivos: (dermatitis, rash)</label>
                    </div>
                    <div>
                        <span wire:click="traumaticos" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->traumaticos) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->traumaticos))
                    <textarea wire:model='personal.traumaticos' class="w-full" rows="4"></textarea>
                @endif

                <div class="flex justify-between mt-6">
                    <div>
                        <label for="regular-form-1" class="form-label">Transfusionales: ¿Cuantos paquetes?</label>
                    </div>
                    <div>
                        <span wire:click="quirurgicos" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->quirurgicos) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->quirurgicos))
                    <textarea wire:model='personal.quirurgicos' class="w-full" rows="4"></textarea>
                @endif

                <div class="flex justify-between mt-6">
                    <div>
                        <label for="regular-form-1" class="form-label">Infecciosos: (Salmonelosis, chinkungunya, tifoidea)</label>
                    </div>
                    <div>
                        <span wire:click="tumorales" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->tumorales) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->tumorales))
                    <textarea wire:model='personal.tumorales' class="w-full" rows="4"></textarea>
                @endif

                <div class="flex justify-between mt-6 mb-5">
                    <div>
                        <label for="regular-form-1" class="form-label">Alergicos: (lidocaina, penicilinas, ketorolaco)</label>
                    </div>
                    <div>
                        <span wire:click="enfermedades" class="btn btn-rounded-success h-4 w-18 mr-1 mb-2 text-xs">
                            {{ is_null($personalPrecedent->enfermedades) ? 'Describir' : 'guardar' }}
                        </span>
                    </div>
                </div>
                @if (!is_null($personalPrecedent->enfermedades))
                    <textarea wire:model='personal.enfermedades' class="w-full" rows="4"></textarea>
                @endif
            </div>
        </div>
    </div>
</div>
