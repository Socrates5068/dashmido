<div>
    <div>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Administrador'])
    </div>

    <div>
        @livewire('admin.users.positions')
    </div>

    <div>
        @livewire('admin.backups')
    </div>
</div>
