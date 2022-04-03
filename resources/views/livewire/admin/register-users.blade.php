<div>
    <div>
        @livewire('admin.menu-bar', ['application' => env('APP_NAME'),
             'content1' => 'Usuarios',
             'content2' => 'Registrar'])
    </div>

    <div>
        @livewire('admin.auth.register')
    </div>
</div>
