<div>
    <div>
        @livewire('admin.menu-bar', ['application' => env('APP_NAME'), 'content1' => 'Usuarios'])
    </div>

    <div class="mb-5">
        @livewire('admin.users.list-users')
    </div>
</div>