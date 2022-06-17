<div>
    <x-notification-message on="success">
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

    <x-notification-message on="error">
        <!-- BEGIN: Notification Content -->
        <div id="save" class="flex toastify-content">
            <div class="relative flex w-full max-w-lg mx-auto my-auto bg-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-4 mr-4">
                    <div class="font-medium">¡Error!</div>
                    <div class="mt-1 text-slate-500">El registro a sido agregado correctamente.</div>
                </div>
            </div>
        </div>
        <!-- END: Notification Content -->
    </x-notification-message>

    <x-notification-message on="delete">
        <!-- BEGIN: Notification Content -->
        <div id="save" class="flex toastify-content">
            <div class="relative flex w-full max-w-lg mx-auto my-auto bg-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="ml-4 mr-4">
                    <div class="font-medium">¡Éxito!</div>
                    <div class="mt-1 text-slate-500">El registro a sido eliminado correctamente.</div>
                </div>
            </div>
        </div>
        <!-- END: Notification Content -->
    </x-notification-message>
    <main>
        <div class="max-w-2xl px-8 py-4 mx-auto mt-10 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h3
                class="mt-4 mb-6 text-2xl font-bold text-gray-700 dark:text-white hover:text-gray-600 dark:hover:text-gray-200">
                Copias de seguridad de la base de datos</h3>
            <div class="row">
                <div class="clearfix col-xs-12">
                    <button wire:click="create" wire:loading.attr="disabled"
                        class="theme-button btn btn-primary pull-right" style="margin-bottom:2em;"> Crear Copia de
                        seguridad </button>
                </div>
                <div class="col-xs-12">
                    @if (count($backups))
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre del archivo</th>
                                    {{-- <th>File Size</th> --}}
                                    {{-- <th>Created Date</th>
                                    <th>Created Age</th> --}}
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($backups as $backup)
                                    <tr>
                                        <td>{{ $backup['file_name'] }}</td>
                                        {{-- <td>{{ \App\Http\Controllers\BackupController::humanFilesize($backup['file_size']) }} --}}
                                        </td>
                                        {{-- <td>
                                            {{ date('F jS, Y, g:ia (T)', $backup['last_modified']) }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($backup['last_modified'])->diffForHumans() }}
                                        </td> --}}
                                        <td class="text-right">
                                            {{-- <a class="btn btn-success" href="javascript:;" target="_blank"><i
                                                    class="fa fa-cloud-download"></i> Descargar</a> --}}
                                            <button wire:click="download('{{ $backup['file_name'] }}')"
                                                class="btn btn-success"><i class="fa fa-cloud-download"></i>
                                                Descargar</button>
                                            <button wire:click="delete('{{ $backup['file_name'] }}')"
                                                class="btn btn-danger"><i class="fa fa-trash-o"></i>
                                                Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="well">
                            <h4>No hay backups</h4>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </main>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
        {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" type="text/javascript"></script> --}}
        <script type="text/javascript">
            $("#CreateBackupForm").on('submit', function(e) {
                $('.theme-button').attr('disabled', 'disabled');
            });
        </script>
        <script>
            function dropdown() {
                return {
                    open: false,
                    show() {
                        if (this.open) {
                            //Close menu
                            this.open = false;
                            document.getElementsByTagName('html')[0].style.overflow = 'auto'
                        } else {
                            //Open menu
                            this.open = true;
                            document.getElementsByTagName('html')[0].style.overflow = 'hidden'
                        }
                    },
                    close() {
                        this.open = false;
                        document.getElementsByTagName('html')[0].style.overflow = 'auto'
                    }
                }
            }
        </script>
    @endpush
</div>
