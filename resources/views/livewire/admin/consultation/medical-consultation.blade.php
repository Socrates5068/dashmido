@php
use App\Models\Consultation;
use App\Models\Staff;
@endphp
@push('styles')
    <style>
        .disabled-link {
            pointer-events: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css"
        integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<div x-data="{ orderCreate: false, orderEdit: false, recipeCreate: false, recipeEdit: false }">
    <x-notification-message on="saved">
        <!-- BEGIN: Notification Content -->
        <div id="save" class="flex toastify-content">
            <div class="relative flex w-full max-w-lg mx-auto my-auto bg-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <button x-on:click="$wire.set('show', 1)" class="mb-2 mr-1 btn btn-sm btn-primary w-30">+ Nuevo
                diagnostico</button>
        </div>
        @if ($consultations->count())
            <!-- ====== Table Section Start -->
            <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-lg font-bold intro-y">
                    Consultas del paciente
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
                                    Estado
                                </th>
                                <th class="whitespace-nowrap">
                                    Médico
                                </th>
                                <th class="whitespace-nowrap">
                                    Diagnostico
                                </th>
                                <th class="whitespace-nowrap">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultations as $key => $consultation)
                                <tr>
                                    <td>
                                        {{ $consultation->id }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($consultation->created_at)) }}
                                    </td>
                                    <td>
                                        @if ($consultation->status == Consultation::FIRST)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-secondary">{{ $consultation->status }}</button>
                                        @elseif ($consultation->status == Consultation::SECOND)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-pending">{{ $consultation->status }}</button>
                                        @elseif ($consultation->status == Consultation::THIRD)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-success">{{ $consultation->status }}</button>
                                        @elseif ($consultation->status == Consultation::DERIVE)
                                            <button
                                                class="mb-2 mr-1 text-xs btn btn-rounded-danger">{{ $consultation->status }}</button>
                                        @endif
                                    </td>
                                    <td>
                                        {{ Staff::find($consultation->staff_id)->person->name }}
                                        {{ Staff::find($consultation->staff_id)->person->f_last_name }}
                                    </td>
                                    <td>
                                        {{ $consultation->diagnostic }}
                                    </td>
                                    <td>
                                        {{-- @if ($consultation->status == Consultation::THIRD)
                                            <p class="inline-block w-24 mb-2 mr-1 btn btn-sm btn-outline-secondary">
                                                Editar
                                            </p>
                                        @else --}}
                                        <button wire:click="editDiagnosis('{{ $consultation->id }}')"
                                            @click="$wire.set('show', 3)"
                                            class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Editar</button>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table Section End -->
            <nav class="hidden w-full mt-4 md:block">
                {{ $consultations->links() }}
            </nav>
            <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                {{ $consultations->links('pagination::tailwind') }}
            </nav>
        @else
            <div class="p-10">
                <div class="mb-2 alert alert-secondary show" role="alert">
                    <div class="flex items-center">
                        <div class="text-lg font-medium">Este paciente aún no tiene consultas registradas.</div>
                    </div>
                    <div class="mt-3">
                        <p>
                            Para registrar uan nueva consultas haga clic en el botón <a
                                class="font-semibold text-blue-600 underline" href="javascript:;">
                                +Nueva
                                consulta </a> </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Create diagnosis --}}
    <div class="{{ $show == 1 ? 'block' : 'hidden' }} px-5 pt-5 intro-y">
        <div class="flex flex-col items-center mt-2 intro-y sm:flex-row">
            <h2 class="mr-auto text-lg font-medium">
                Nuevo diagnostico
            </h2>
            <div class="flex w-full mt-4 sm:w-auto sm:mt-0">
                <button wire:click="resetVariables" @click="$wire.set('show', 0,), $wire.set('saveControl', 0,)"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-danger" aria-expanded="false"
                    data-tw-toggle="dropdown"> Cancelar
                </button>
                <button @click="orderCreate = true"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-primary" aria-expanded="false"
                    data-tw-toggle="dropdown" {{ $saveControl == 0 ? 'disabled' : '' }}> Nueva orden
                </button>
                <button @click="$wire.set('show', 0,)"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-primary" aria-expanded="false"
                    data-tw-toggle="dropdown" {{ $saveControl == 0 ? 'disabled' : '' }}> Nueva receta
                </button>
                <div class="dropdown">
                    <button id="drop" class="flex items-center shadow-md dropdown-toggle btn btn-primary"
                        aria-expanded="false" data-tw-toggle="dropdown" {{ $saveControl == 0 ? '' : 'disabled' }}>
                        Guardar
                        <svg width="12" height="12" class="ml-2 fill-white" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <polyline fill="" stroke="#000" stroke-width="2"
                                points="7.086 3.174 17.086 13.174 7.086 23.174"
                                transform="scale(1 -1) rotate(-89 -1.32 0)" />
                        </svg>
                    </button>
                    <div class="dropdown-menu w-52">
                        <ul class="dropdown-content">
                            <li>
                                <button wire:click="save('{{ Consultation::FIRST }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::FIRST }}
                                </button>
                            </li>
                            <li>
                                <button wire:click="save('{{ Consultation::SECOND }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::SECOND }} </button>
                            </li>
                            <li>
                                <button wire:click="save('{{ Consultation::THIRD }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::THIRD }}
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap-5 mt-5 post intro-y">
            <!-- BEGIN: Post Content -->
            <div class="intro-y lg:col-span-8">
                <div class="mt-5 overflow-hidden post intro-y box">
                    <div class="post__content tab-content">
                        <div id="content" class="p-5 tab-pane active" role="tabpanel"
                            aria-labelledby="content-tab">
                            <div class="p-5 border rounded-md border-slate-200/60 dark:border-darkmode-400">
                                <div
                                    class="flex items-center pb-5 font-medium border-b border-slate-200/60 dark:border-darkmode-400">
                                    Descripción
                                </div>
                                <textarea wire:model="consultationDescription" class="form-control w-full h-40"></textarea>
                                <label for="regular-form-1" class="form-label">Diagnostico</label>
                                <input wire:model="diagnostic" type="text" class="form-control"
                                    placeholder="Ej. Gastroenteritis">
                                {{-- <div wire:ignore class="mt-5">
                                    <div id="toolbar-container"></div>
                                    <div id="editor">
                                        <p><strong>SUBJETIVO:</strong></p>
                                        <p>&nbsp;</p>
                                        <p><strong>OBJETIVO:</strong></p>
                                        <p>&nbsp;</p>
                                        <p><strong>ANALISIS (diagnostico):</strong></p>
                                        <p>&nbsp;</p>
                                        <p><strong>PLAN DE TRATAMIENTO:</strong></p>
                                    </div>
                                </div> --}}
                            </div>
                            {{-- <div class="p-5 mt-5 border rounded-md border-slate-200/60 dark:border-darkmode-400">
                                <div
                                    class="flex items-center pb-5 font-medium border-b border-slate-200/60 dark:border-darkmode-400">
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
                                        <div class="pt-4 border-2 border-dashed rounded-md dark:border-darkmode-400">
                                            <div class="flex flex-wrap px-4">
                                                <div
                                                    class="relative w-24 h-24 mb-5 mr-5 cursor-pointer image-fit zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-4.jpg">
                                                    <div title="Remove this image?"
                                                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full tooltip bg-danger">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="relative w-24 h-24 mb-5 mr-5 cursor-pointer image-fit zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-12.jpg">
                                                    <div title="Remove this image?"
                                                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full tooltip bg-danger">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="relative w-24 h-24 mb-5 mr-5 cursor-pointer image-fit zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-7.jpg">
                                                    <div title="Remove this image?"
                                                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full tooltip bg-danger">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                                <div
                                                    class="relative w-24 h-24 mb-5 mr-5 cursor-pointer image-fit zoom-in">
                                                    <img class="rounded-md" alt="Midone - HTML Admin Template"
                                                        src="dist/images/preview-2.jpg">
                                                    <div title="Remove this image?"
                                                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 -mt-2 -mr-2 text-white rounded-full tooltip bg-danger">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="relative flex items-center px-4 pb-4 cursor-pointer">
                                                <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span
                                                    class="mr-1 text-primary">Upload a file</span> or drag and drop
                                                <input type="file"
                                                    class="absolute top-0 left-0 w-full h-full opacity-0">
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

    {{-- Edit diagnosis --}}
    <div class="{{ $show == 3 ? 'block' : 'hidden' }} px-5 pt-5 intro-y">
        <div class="flex flex-col items-center mt-2 intro-y sm:flex-row">
            <h2 class="mr-auto text-lg font-medium">
                Editar
            </h2>
            <div class="flex w-full mt-4 sm:w-auto sm:mt-0">
                <button wire:click="resetVariables" @click="$wire.set('show', 0,), $wire.set('saveControl', 0,)"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-danger" aria-expanded="false"
                    data-tw-toggle="dropdown"> Cancelar
                </button>
                <button @click="orderCreate = true"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-primary" aria-expanded="false"
                    data-tw-toggle="dropdown"> Nueva orden
                </button>
                <button @click="recipeCreate = true"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-primary" aria-expanded="false"
                    data-tw-toggle="dropdown"> Nueva receta
                </button>
                <button wire:click="infirmary"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-pending " aria-expanded="false"
                    data-tw-toggle="dropdown"> Derivar a enfermería
                </button>
                <button wire:click="deriveDepartment"
                    class="flex items-center mr-4 shadow-md dropdown-toggle btn btn-pending " aria-expanded="false"
                    data-tw-toggle="dropdown"> Derivar a especialidad
                </button>
                <div class="dropdown">
                    <button id="drop" class="flex items-center shadow-md dropdown-toggle btn btn-primary"
                        aria-expanded="false" data-tw-toggle="dropdown"> Actualizar
                        <svg width="12" height="12" class="ml-2 fill-white" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <polyline fill="" stroke="#000" stroke-width="2"
                                points="7.086 3.174 17.086 13.174 7.086 23.174"
                                transform="scale(1 -1) rotate(-89 -1.32 0)" />
                        </svg>
                    </button>
                    <div class="dropdown-menu w-52">
                        <ul class="dropdown-content">
                            <li>
                                <button wire:click="updateDiagnosis('{{ Consultation::FIRST }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::FIRST }}
                                </button>
                            </li>
                            <li>
                                <button wire:click="updateDiagnosis('{{ Consultation::SECOND }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::SECOND }} </button>
                            </li>
                            <li>
                                <button wire:click="updateDiagnosis('{{ Consultation::THIRD }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::THIRD }}
                                </button>
                            </li>
                            <li>
                                <button wire:click="updateDiagnosis('{{ Consultation::DERIVE }}')" @click="ocultar"
                                    class="dropdown-item"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                    {{ Consultation::DERIVE }}
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="gap-5 mt-5 post intro-y">
            <!-- BEGIN: Post Content -->
            <div class="intro-y lg:col-span-8">
                <div class="mt-5 overflow-hidden post intro-y box">
                    <div class="post__content tab-content">
                        <div id="content" class="p-5 tab-pane active" role="tabpanel"
                            aria-labelledby="content-tab">
                            <div class="p-5 border rounded-md border-slate-200/60 dark:border-darkmode-400">
                                <div
                                    class="flex items-center pb-5 font-medium border-b border-slate-200/60 dark:border-darkmode-400">
                                    Descripción
                                </div>
                                <textarea wire:model="consultationDescription" class="form-control w-full h-40"></textarea>
                                <label for="regular-form-1" class="form-label">Diagnostico</label>
                                <input wire:model="diagnostic" type="text" class="form-control"
                                    placeholder="Ej. Gastroenteritis">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Orders --}}
        <div class="gap-5 mt-5 post intro-y">
            <h2 class="mr-auto text-lg font-medium">
                Ordenes
            </h2>
            @isset($orders)
                @if ($orders->count())
                    <!-- ====== Table Section Start -->
                    <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
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
                                            Descripción
                                        </th>
                                        <th class="whitespace-nowrap">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td>
                                                {{ $order->id }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($order->created_at)) }}
                                            </td>
                                            <td>
                                                {{ Staff::find($order->staff_id)->person->name }}
                                                {{ Staff::find($order->staff_id)->person->f_last_name }}
                                                {{ Staff::find($order->staff_id)->person->m_last_name }}
                                            </td>
                                            <td>
                                                {{ substr($order->description, 0, 10) }}
                                            </td>
                                            <td>
                                                @if ($key == 0)
                                                    <button wire:click="edit('{{ $order->id }}')"
                                                        @click="orderEdit = true"
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Editar</button>
                                                    <a href="{{ route('admin.order', $order->id) }}"
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Imprimir</a>
                                                @else
                                                    <button
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-out-primary">Editar</button>
                                                    <a href="{{ route('admin.order', $order->id) }}"
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Imprimir</a>
                                                @endif

                                                <a href="{{ route('admin.showOrder', $order->id) }}" target="_blank"
                                                    class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Mostrar</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ====== Table Section End -->
                    <nav class="hidden w-full mt-4 md:block">
                        {{ $orders->links() }}
                    </nav>
                    <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                        {{ $orders->links('pagination::tailwind') }}
                    </nav>
                @else
                    <div class="p-10">
                        <div class="mb-2 alert alert-secondary show" role="alert">
                            <div class="flex items-center">
                                <div class="text-lg font-medium">Este paciente aún no tiene ordenes registradas.</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endisset
        </div>

        {{-- Recipes --}}
        <div class="gap-5 mt-5 post intro-y">
            <h2 class="mr-auto text-lg font-medium">
                Recetas
            </h2>
            @isset($recipes)
                @if ($recipes->count())
                    <!-- ====== Table Section Start -->
                    <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
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
                                            Descripción
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
                                                {{ Staff::find($recipe->staff_id)->person->m_last_name }}
                                            </td>
                                            <td>
                                                @php
                                                    $des = json_decode($recipe->description, true);
                                                @endphp
                                                @if (!empty($des))
                                                    {{ substr($des[0][1], 0, 10) }}
                                                @endif

                                            </td>
                                            <td>
                                                @if ($key == 0)
                                                    <button wire:click="editRecipeObecjt('{{ $recipe->id }}')"
                                                        @click="recipeEdit = true"
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Editar</button>
                                                    <a href="{{ route('admin.recipe', $recipe->id) }}"
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Imprimir</a>
                                                @else
                                                    <button
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-out-primary">Editar</button>
                                                    <a href="{{ route('admin.recipe', $recipe->id) }}"
                                                        class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Imprimir</a>
                                                @endif

                                                <a href="{{ route('admin.showRecipe', $recipe->id) }}" target="_blank"
                                                    class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Mostrar</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- ====== Table Section End -->
                    <nav class="hidden w-full mt-4 md:block">
                        {{ $orders->links() }}
                    </nav>
                    <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                        {{ $orders->links('pagination::tailwind') }}
                    </nav>
                @else
                    <div class="p-10">
                        <div class="mb-2 alert alert-secondary show" role="alert">
                            <div class="flex items-center">
                                <div class="text-lg font-medium">Este paciente aún no tiene recetas registradas.</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endisset
        </div>
    </div>

    {{-- modal Create orders --}}
    <div x-show="orderCreate" :class="{ 'show': orderCreate, '': !orderCreate }" class="modal-personal"
        tabindex="-1" aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="orderCreate = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div>
                        <label>Descripción de la orden</label>
                        <div class="mt-2">
                            <textarea wire:model="orderDescription" name="" id="" cols="50" rows="5"></textarea>
                            <x-jet-input-error for="deleteRole" />
                        </div>
                    </div>
                    <div class="">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button class="mr-1 btn btn-primary" wire:click="resetVariables"
                            @click="orderCreate = false, $wire.set('saveControl', 0,)">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="saveOrder"
                            @click="print, Livewire.on('saved', () => {orderCreate = false; } )"
                            class="mr-1 btn btn-primary" {{-- {{ $saveControl == 0 ? 'disabled' : '' }} --}}>Guardar</button>

                        {{-- <a wire:click="saveOrderPrint" target="_blank"
                            href="{{ $order_id ? route('admin.order', $order_id) : route('admin.order', 1) }}"
                            class="mr-1 btn {{ $saveControl == 0 ? 'btn-primary' : 'disabled-link btn-outline-primary' }}">Imprimir</a>
                        <!-- END: Toggle Modal Toggle --> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal EditOrders --}}
    <div x-show="orderEdit" :class="{ 'show': orderEdit, '': !orderEdit }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="orderEdit = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div>
                        <label>Descripción de la orden</label>
                        <div class="mt-2">
                            <textarea wire:model="orderDescription" name="" id="" cols="50" rows="5"></textarea>
                            <x-jet-input-error for="deleteRole" />
                        </div>
                    </div>
                    <div class="">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button class="mr-1 btn btn-primary" wire:click="resetVariables"
                            @click="orderEdit = false, $wire.set('saveControl', 0,)">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="updateOrder('{{ $aux }}')"
                            @click="Livewire.on('saved', () => {orderEdit = false; } )" class="mr-1 btn btn-primary"
                            {{ $saveControl == 0 ? '' : 'disabled' }}>Actualizar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal Create recipes --}}
    {{-- <div x-show="recipeCreate" :class="{ 'show': recipeCreate, '': !recipeCreate }" class="modal-personal"
        tabindex="-1" aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog modal-lg">
            <div class="modal-content" @click.away="recipeCreate = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-2">
                            <label>Cantidad</label>
                            <input wire:model="quantity" type="number" class="form-control" min="0"
                                max="100">
                            <x-jet-input-error for="quantity" />
                        </div>
                        <div class="col-span-7">
                            <label>Medicamento</label>
                            <input wire:model="medicine" type="text" class="form-control">
                            <x-jet-input-error for="medicine" />
                        </div>
                        <div class="col-span-3">
                            <label>Indicación</label>
                            <input wire:model="instruction" type="text" class="form-control">
                            <x-jet-input-error for="instruction" />
                        </div>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        Cantidad
                                    </th>
                                    <th class="whitespace-nowrap">
                                        Medicamento
                                    </th>
                                    <th class="whitespace-nowrap">
                                        indicación
                                    </th>
                                    <th class="whitespace-nowrap">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($descriptionRecipe as $key => $desRecipe)
                                    <tr>
                                        <td>
                                            {{ $desRecipe[0] }}
                                        </td>
                                        <td>
                                            {{ $desRecipe[1] }}
                                        </td>
                                        <td>
                                            {{ $desRecipe[2] }}
                                        </td>
                                        <td>
                                            <button wire:click="editRecipe('{{ $key }}')">editar</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button class="mr-1 btn btn-primary" wire:click="resetVariables"
                            @click="recipeCreate = false">Cerrar</button>

                        @if ($recipeControl == 0)
                            <button wire:click="addRecipe" class="mr-1 btn btn-primary">Agregar</button>
                        @else
                            <button wire:click="updateRecipe" class="mr-1 btn btn-primary">Actualizar</button>
                        @endif
                        <button wire:click="saveRecipe"
                            @click="print, Livewire.on('saved', () => {recipeCreate = false; } )"
                            class="mr-1 btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Modal para registrar productos --}}
    <div x-show="recipeCreate" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <!-- Modal -->
        <div x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0  transform translate-y-1/2"
            @click.away="recipeCreate = false, Livewire.emit('resetRecipe')"
            @keydown.escape="recipeCreate = false, Livewire.emit('resetRecipe')" {{-- Esto hace que el modal no se abra ni bien se entra en la pagina --}}
            :class="{ 'block': recipeCreate, 'hidden': !recipeCreate }"
            class="hidden w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="modal">
            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
            <header class="flex justify-end">
                <button
                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                    aria-label="close" @click="recipeCreate = false, Livewire.emit('resetRecipe')">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                        <path
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" fill-rule="evenodd">
                        </path>
                    </svg>
                </button>
            </header>
            <!-- Modal body -->
            <div class="mt-4 mb-6">
                <!-- Modal title -->
                <p class="mb-2 text-lg font-semibold text-green-700 dark:text-green-700">
                    Nueva receta {{  $gname }}
                </p>
                <div class="p-10 text-center modal-body">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-2">
                            <label>Cantidad</label>
                            <input wire:model="quantity" type="number" class="form-control" min="0"
                                max="100">
                            <x-jet-input-error for="quantity" />
                        </div>
                        <div class="col-span-7">
                            <label>Medicamento</label>
                            <x-lwa::autocomplete
                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            name="generic-name"
                            wire:model-text="gname"
                            wire:model-id="gnameId"
                            wire:model-results="gnames"
                            :options="[
                                'text'=> 'gname',
                                'allow-new'=> 'true',
                            ]" />
                            <x-jet-input-error for="gname" />
                        </div>
                        <div class="col-span-3">
                            <label>Indicación</label>
                            <input wire:model="instruction" type="text" class="form-control">
                            <x-jet-input-error for="instruction" />
                        </div>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        Cantidad
                                    </th>
                                    <th class="whitespace-nowrap">
                                        Medicamento
                                    </th>
                                    <th class="whitespace-nowrap">
                                        indicación
                                    </th>
                                    <th class="whitespace-nowrap">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($descriptionRecipe as $key => $desRecipe)
                                    <tr>
                                        <td>
                                            {{ $desRecipe[0] }}
                                        </td>
                                        <td>
                                            {{ $desRecipe[1] }}
                                        </td>
                                        <td>
                                            {{ $desRecipe[2] }}
                                        </td>
                                        <td>
                                            <button wire:click="editRecipe('{{ $key }}')">editar</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                <div class="mt-4">
                    <button class="mr-1 btn btn-primary" wire:click="resetRecipe"
                        @click="recipeCreate = false">Cerrar</button>

                    @if ($recipeControl == 0)
                        <button wire:click="addRecipe" class="mr-1 btn btn-primary">Agregar</button>
                    @else
                        <button wire:click="updateRecipe" class="mr-1 btn btn-primary">Actualizar</button>
                    @endif
                    <button wire:click="saveRecipe"
                        @click="print, Livewire.on('saved', () => {recipeCreate = false; } )"
                        class="mr-1 btn btn-primary">Guardar</button>
                </div>
            </footer>
        </div>
    </div>


    {{-- modal Edit recipes --}}
    <div x-show="recipeEdit" :class="{ 'show': recipeEdit, '': !recipeEdit }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog modal-lg">
            <div class="modal-content" @click.away="recipeEdit = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-2">
                            <label>Cantidad</label>
                            <input wire:model="quantity" type="number" class="form-control">
                            <x-jet-input-error for="quantity" />
                        </div>
                        <div class="col-span-7">
                            <label>Medicamento</label>
                            <input wire:model="medicine" type="text" class="form-control">
                            <x-jet-input-error for="medicine" />
                        </div>
                        <div class="col-span-3">
                            <label>Indicación</label>
                            <input wire:model="instruction" type="text" class="form-control">
                            <x-jet-input-error for="instruction" />
                        </div>
                    </div>

                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        Cantidad
                                    </th>
                                    <th class="whitespace-nowrap">
                                        Medicamento
                                    </th>
                                    <th class="whitespace-nowrap">
                                        indicación
                                    </th>
                                    <th class="whitespace-nowrap">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($descriptionRecipe as $key => $desRecipe)
                                    <tr>
                                        <td>
                                            {{ $desRecipe[0] }}
                                        </td>
                                        <td>
                                            {{ $desRecipe[1] }}
                                        </td>
                                        <td>
                                            {{ $desRecipe[2] }}
                                        </td>
                                        <td>
                                            <button wire:click="editRecipe('{{ $key }}')">editar</button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <button class="mr-1 btn btn-primary" wire:click="resetVariables"
                            @click="recipeEdit = false, Livewire.emit('resetVariables')">Cerrar</button>

                        @if ($recipeControl == 0)
                            <button wire:click="addRecipe" class="mr-1 btn btn-primary">Agregar</button>
                        @else
                            <button wire:click="updateRecipe" class="mr-1 btn btn-primary">Actualizar</button>
                        @endif

                        <button wire:click="updateRecipeObject"
                            @click="print, Livewire.on('saved', () => {recipeEdit = false; } )"
                            class="mr-1 btn btn-primary" {{-- {{ $saveControl == 0 ? 'disabled' : '' }} --}}>Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/decoupled-document/ckeditor.js"></script>

        {{-- create diagnosis --}}
        <script>
            function ocultar() {
                // console.log('😀');
                // Hide dropdown
                const el = document.querySelector("#drop");
                const dropdown = tailwind.Dropdown.getOrCreateInstance(el);
                dropdown.hide();
            }

            /* let description;
            let descriptionEdit;
            let contentConsultation =
                '<p><strong>SUBJETIVO:</strong></p><p>&nbsp;</p><p><strong>OBJETIVO:</strong></p><p>&nbsp;</p><p><strong>ANALISIS (diagnostico):</strong></p><p>&nbsp;</p><p><strong>PLAN DE TRATAMIENTO:</strong></p>'
            document.addEventListener('livewire:load', function() {
                DecoupledEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        const toolbarContainer = document.querySelector('#toolbar-container');

                        toolbarContainer.appendChild(editor.ui.view.toolbar.element);
                        description = editor;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            })

            function save(status) {
                // console.log(description.getData())
                Livewire.emit('save', status, description.getData());
                description.setData(contentConsultation)

                // Hide dropdown
                const el = document.querySelector("#drop");
                const dropdown = tailwind.Dropdown.getOrCreateInstance(el);
                dropdown.hide();
            }

            function clean() {
                description.setData(contentConsultation)
            } */
        </script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"
                integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            var trix = document.querySelector("trix-editor")
            trix.editor // is a Trix.Editor instance
            function print() {
                console.log(trix.editor.getDocument());
            }
        </script> --}}
    @endpush
</div>
