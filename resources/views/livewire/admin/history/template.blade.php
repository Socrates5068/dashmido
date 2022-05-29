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
                <li id="profile-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="flex items-center py-4 nav-link active" data-tw-target="#profile"
                        aria-controls="profile" aria-selected="true" role="tab"> <i class="w-4 h-4 mr-2"
                            data-lucide="user"></i> Profile </a>
                </li>
                <li id="account-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="flex items-center py-4 nav-link" data-tw-target="#account"
                        aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="shield"></i> Account
                    </a>
                </li>
                <li id="change-password-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="flex items-center py-4 nav-link" data-tw-target="#change-password"
                        aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="lock"></i> Change
                        Password </a>
                </li>
                <li id="settings-tab" class="nav-item" role="presentation">
                    <a href="javascript:;" class="flex items-center py-4 nav-link" data-tw-target="#settings"
                        aria-selected="false" role="tab"> <i class="w-4 h-4 mr-2" data-lucide="settings"></i>
                        Settings </a>
                </li>
            </ul>
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
