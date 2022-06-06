@php
use App\Models\Consultation;
use App\Models\Staff;
@endphp
<div x-data>
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

    <div class="{{ $show == 0 ? 'block' : 'hidden' }} intro-y">
        <div class="mt-4">
            <button x-on:click="$wire.set('show', 1)" class="btn btn-sm btn-primary w-30 mr-1 mb-2">+ Nueva
                receta</button>
        </div>
        @if ($recipes->count())
            <!-- ====== Table Section Start -->
            <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-lg font-bold intro-y">
                    Recetas del paciente
                </h2>
                <div class="intro-y">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">
                                    Nº
                                </th>
                                <th class="whitespace-nowrap">
                                    Fecha
                                </th>
                                <th class="whitespace-nowrap">
                                    Médico
                                </th>
                                <th class="whitespace-nowrap">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $key => $recipe)
                                <tr>
                                    <td>
                                        {{ $recipe->id }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($recipe->created_at)) }}
                                    </td>
                                    <td>
                                        {{ Staff::find($recipe->staff_id)->person->name }}
                                        {{ Staff::find($recipe->staff_id)->person->f_last_name }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary w-24 inline-block mr-1 mb-2">
                                            Editar
                                        </button>
                                        <a href="{{ route('admin.recipe', $recipe->id) }}" class="btn btn-sm btn-dark w-24 inline-block mr-1 mb-2">
                                            Imprimir
                                        </a>
                                    </td>   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table Section End -->
            <nav class="hidden mt-4 w-full md:block">
                {{ $recipes->links() }}
            </nav>
            <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                {{ $recipes->links('pagination::tailwind') }}
            </nav>
        @else
            <div class="p-10">
                <div class="mb-2 alert alert-secondary show" role="alert">
                    <div class="flex items-center">
                        <div class="text-lg font-medium">Este paciente aún no tiene recetas registradas.</div>
                    </div>
                    <div class="mt-3">
                        <p>
                            Para registrar uan nueva receta haga clic en el botón <a
                                class="font-semibold text-blue-600 underline" href="{{ route('admin.patients') }}">
                                +Nueva
                                receta </a> </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="{{ $show == 1 ? 'block' : 'hidden' }} px-5 pt-5 intro-y">
        <div class="intro-y flex flex-col sm:flex-row items-center mt-2">
            <h2 class="text-lg font-medium mr-auto">
                Nueva receta
            </h2>
            <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                <button @click="$wire.set('show', 0,), cleanRecipe()"
                    class="mr-4 dropdown-toggle btn btn-danger shadow-md flex items-center" aria-expanded="false"
                    data-tw-toggle="dropdown"> Cancelar
                </button>
                <button @click="saveRecipe" class="mr-4 dropdown-toggle btn btn-primary shadow-md flex items-center"
                    aria-expanded="false" data-tw-toggle="dropdown"> Guardar
                </button>
                <button class="mr-4 dropdown-toggle btn btn-secondary shadow-md flex items-center" aria-expanded="false"
                    data-tw-toggle="dropdown"> Imprimir
                </button>
            </div>
        </div>
        <div class="post intro-y gap-5 mt-5">
            <!-- BEGIN: Post Content -->
            <div class="intro-y lg:col-span-8">
                <div class="post intro-y overflow-hidden box mt-5">
                    <div class="post__content tab-content">
                        <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                            <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                                <div
                                    class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                    Descripción
                                </div>
                                <div wire:ignore class="mt-5">
                                    <div id="toolbar-recipe"></div>
                                    <div id="recipe">
                                        <figure class="table">
                                            <table>
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Medicamento</strong></td>
                                                        <td><strong>Indicaciones</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                                <div
                                    class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5">
                                    <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Caption & Images
                                </div>
                                <div class="mt-5">
                                    <div>
                                        <label for="post-form-7" class="form-label">Caption</label>
                                        <input id="post-form-7" type="text" class="form-control"
                                            placeholder="Write caption">
                                    </div>
                                    <div class="mt-3">
                                        <label class="form-label">Upload Image</label>
                                        <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                            <div class="flex flex-wrap px-4">
                                                <div
                                                    class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-4.jpg">
                                                    <div title="Remove this image?"
                                                        class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-12.jpg">
                                                    <div title="Remove this image?"
                                                        class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-7.jpg">
                                                    <div title="Remove this image?"
                                                        class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-2.jpg">
                                                    <div title="Remove this image?"
                                                        class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span
                                                    class="text-primary mr-1">Upload a file</span> or drag and drop
                                                <input type="file"
                                                    class="w-full h-full top-0 left-0 absolute opacity-0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/decoupled-document/ckeditor.js"></script> --}}
        <script>
            let recipeDescription;
            contentRecipe =
                    '<figure class="table"><table><tbody><tr><td><strong>Medicamento</strong></td><td><strong>Indicaciones</strong></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>'
            document.addEventListener('livewire:load', function() {
                DecoupledEditor
                    .create(document.querySelector('#recipe'))
                    .then(editor => {
                        const toolbarContainer = document.querySelector('#toolbar-recipe');

                        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                        recipeDescription = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })

            function saveRecipe() {
                // console.log(recipeDescription.getData())
                Livewire.emit('saveRecipe', recipeDescription.getData());
                recipeDescription.setData(contentRecipe)
            }

            function cleanRecipe() {
                recipeDescription.setData(contentRecipe)
            }
        </script>
    @endpush
</div>
