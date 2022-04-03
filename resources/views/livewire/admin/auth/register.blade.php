<div>

    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Form Validation
        </h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Validation -->
            <div class="intro-y box">

                <div id="form-validation" class="p-5">
                    <div class="preview">
                        <!-- BEGIN: Validation Form -->
                        <form class="validate-form">
                            <div class="input-form">
                                <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Name
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at least 2
                                        characters</span> </label>
                                <input wire:model="name" id="validation-form-1" type="text" name="name"
                                    class="form-control" placeholder="John Legend" minlength="2">
                                <x-jet-input-error for="name" />
                                @error('name')
                                    <div id="failed-notification-content" class="toastify-content hidden flex">
                                        <i class="text-danger" data-lucide="x-circle"></i>
                                        <div class="ml-4 mr-4">
                                            <div class="font-medium">Registration failed!</div>
                                            <div class="text-slate-500 mt-1"> Please check the fileld form. </div>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-2" class="form-label w-full flex flex-col sm:flex-row">
                                    Email <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, email
                                        address format</span> </label>
                                <input id="validation-form-2" type="email" name="email" class="form-control"
                                    placeholder="example@gmail.com">
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-3" class="form-label w-full flex flex-col sm:flex-row">
                                    Password <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at
                                        least 6 characters</span> </label>
                                <input id="validation-form-3" type="password" name="password" class="form-control"
                                    placeholder="secret" minlength="6">
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-4" class="form-label w-full flex flex-col sm:flex-row"> Age
                                    <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, integer only
                                        & maximum 3 characters</span> </label>
                                <input id="validation-form-4" type="number" name="age" class="form-control"
                                    placeholder="21">
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-5" class="form-label w-full flex flex-col sm:flex-row">
                                    Profile URL <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Optional,
                                        URL format</span> </label>
                                <input id="validation-form-5" type="url" name="url" class="form-control"
                                    placeholder="https://google.com">
                            </div>
                            <div class="input-form mt-3">
                                <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row">
                                    Comment <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Required, at
                                        least 10 characters</span> </label>
                                <textarea id="validation-form-6" class="form-control" name="comment" placeholder="Type your comments" minlength="10"
                                    ></textarea>
                            </div>
                            <button wire:click="save" type="submit" class="btn btn-primary mt-5">Register</button>
                        </form>
                        <!-- END: Validation Form -->
                        <!-- BEGIN: Success Notification Content -->
                        <div id="success-notification-content" class="toastify-content hidden flex">
                            <i class="text-success" data-lucide="check-circle"></i>
                            <div class="ml-4 mr-4">
                                <div class="font-medium">Registration success!</div>
                                <div class="text-slate-500 mt-1"> Please check your e-mail for further info! </div>
                            </div>
                        </div>
                        <!-- END: Success Notification Content -->
                        <!-- BEGIN: Failed Notification Content -->
                        <div id="failed-notification-content" class="toastify-content hidden flex">
                            <i class="text-danger" data-lucide="x-circle"></i>
                            <div class="ml-4 mr-4">
                                <div class="font-medium">Registration failed!</div>
                                <div class="text-slate-500 mt-1"> Please check the fileld form. </div>
                            </div>
                        </div>
                        <!-- END: Failed Notification Content -->
                    </div>
                </div>
            </div>
            <!-- END: Form Validation -->
        </div>
    </div>

    {{-- <x-jet-action-message class="" on="saved">
        <div id="success-notification-content" class="toastify-content hidden flex" >
            <i class="text-success" data-lucide="check-circle"></i> 
            <div class="ml-4 mr-4">
                <div class="font-medium">¡Registro exitoso!</div>
                <div class="text-slate-500 mt-1"> ¡Revise su correo para más información! </div>
            </div>
        </div>
    </x-jet-action-message>
    
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <!-- BEGIN: Form Layout -->
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">Nombre</label>
                    <input wire:model="name" id="crud-form-1" type="text" class="form-control w-full" placeholder="Ej. Juan Pérez">
                    <x-jet-input-error for="name" />
                    
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Correo</label>
                    <input wire:model="email" id="crud-form-1" type="text" class="form-control w-full" placeholder="Ej. juanperes@correo.com">
                    <x-jet-input-error for="email" />
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Contraseña</label>
                    <input wire:model="password" type="password" id="crud-form-1" type="text" class="form-control w-full" placeholder="Ingrese su contraseña">
                    <x-jet-input-error for="password" />
                </div>
                <div class="mt-3">
                    <label for="crud-form-1" class="form-label">Confirmar contraseña</label>
                    <input wire:model="passwordConfirmation" type="password" id="crud-form-1" type="text" class="form-control w-full" placeholder="Ingrese su contraseña nuevamente">
                    <x-jet-input-error for="passwordConfirmation" />
                </div>
                <div class="mt-3">
                    <label for="crud-form-2" class="form-label">Seleccionar rol</label>
                    <select data-placeholder="Seleccione un rol" class="tom-select w-full" id="crud-form-2">
                        <option value="user" selected>Usuario</option>
                        <option value="admin">Administrador</option>
                    </select>
                    <x-jet-input-error for="role" />
                </div>
                
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                    <button wire:click="save" type="button" class="btn btn-primary w-24">Save</button>
                </div>
            </div>
            <!-- END: Form Layout -->
        </div>
    </div> --}}
</div>
