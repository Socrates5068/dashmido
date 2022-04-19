<div>
    <div>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Usuarios'])
    </div>

    <div class="mb-5">
        @livewire('admin.users.list-users')
    </div>
</div>