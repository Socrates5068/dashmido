<div>
    @isset($person->patient->id)
        <div wire:ignore>
            @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Pacientes', 'content2' => $person->name . ' ' . $person->f_last_name . ' ' . $person->m_last_name])
        </div>

        <div wire:ignore>
            @livewire('admin.history.profile', ['person' => $person])
        </div>

        <div class="mt-5 intro-y box">
            <ul class="flex-col justify-center text-center nav nav-link-tabs sm:flex-row lg:justify-start" role="tablist">
                <li wire:click='menu(1)' class="{{ $menu == 1 ? 'nav-item' : '' }}" role="presentation">
                    <a wire:ignore href="javascript:;" class="flex items-center py-4 nav-link active"
                        data-tw-target="#profile" aria-controls="profile" aria-selected="true" role="tab"> <i
                            class="w-4 h-4 mr-2" data-lucide="user"></i> Historia clínica </a>
                </li>
                <li wire:click='menu(2)' class="{{ $menu == 2 ? 'nav-item' : '' }}" role="presentation">
                    <a wire:ignore href="javascript:;" class="flex items-center py-4 nav-link active" data-tw-target="#account"
                        aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="shield"></i> Consultas
                    </a>
                </li>
                <li wire:click='menu(3)' class="{{ $menu == 3 ? 'nav-item' : '' }}" role="presentation">
                    <a wire:ignore href="javascript:;" class="flex items-center py-4 nav-link active"
                        data-tw-target="#change-password" aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2"
                            data-lucide="lock"></i> Recetas </a>
                </li>
            </ul>
        </div>

        <div class="{{ $menu == 1 ? 'block' : 'hidden' }}">
            <div wire:ignore>
                @livewire('admin.history.precedents', ['patient_id' => $person->patient->id])
            </div>

            <div wire:ignore>
                @livewire('admin.history.non-pathological-precedents', ['patient_id' => $person->patient->id])
            </div>
        </div>

        <div class="{{ $menu == 2 ? 'block' : 'hidden' }}">
            <div wire:ignore>
                @livewire('admin.consultation.medical-consultation', ['patient_id' => $person->patient->id])
            </div>
        </div>

        <div class="{{ $menu == 3 ? 'block' : 'hidden' }}">
            <div wire:ignore>
                @livewire('admin.recipe.recipes', ['patient_id' => $person->patient->id])
            </div>
        </div>
    @else
        <div wire:ignore>
            @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Pacientes', 'content2' => 'error'])
        </div>
        <div class="p-10">
            <div class="mb-2 alert alert-secondary show" role="alert">
                <div class="flex items-center">
                    <div class="text-lg font-medium">Error. Paciente no encontrado.</div>
                </div>
                <div class="mt-3">
                    <p>
                        Para registrar un paciente dirijase a <a class="font-semibold text-blue-600 underline"
                            href="{{ route('admin.patients') }}"> Pacientes. </a> </p>
                </div>
            </div>
        </div>
    @endisset
</div>
