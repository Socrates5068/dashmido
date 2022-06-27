@php
use App\Models\Consultation;
use App\Models\Staff;
@endphp
<div x-data="{ attention: false, editAttention: false }">
    <div wire:ignore>
        @livewire('admin.menu-bar', ['application' => config('app.name'), 'content1' => 'Enfermería'])
    </div>

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

    <div class="grid grid-cols-3 gap-6 mt-5">
        <div class="">
            <a href="{{ route('admin.patients') }}" class="mb-2 mr-1 w-36 btn btn-primary">Registrar paciente</a>
        </div>
        <div class="">
            {{-- <button @click="attention = true" class="mb-2 mr-1 w-36 btn btn-primary">Nueva atención</button> --}}
        </div>
        <div class="">
        </div>
    </div>

    {{-- Attentions --}}
    <div class="intro-y mt-8">
        <h2 class="mr-auto text-lg font-medium">
            Atenciones
        </h2>
        @if ($attentions->count())
            <!-- ====== Table Section Start -->
            <div class="relative p-8 mt-4 bg-white rounded-lg shadow-lg">
                <h2 class="mb-4 text-lg font-bold intro-y">
                    Atenciones
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
                                    Descripción
                                </th>
                                <th class="whitespace-nowrap">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attentions as $key => $attention)
                                <tr>
                                    <td>
                                        {{ $attention->id }}
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($attention->created_at)) }}
                                    </td>
                                    <td>
                                        {{ substr($attention->description, 0, 10) }}
                                    </td>
                                    <td>
                                        <button wire:click="edit('{{ $attention->id }}')"
                                            @click="editAttention = true"
                                            class="w-24 mb-2 mr-1 btn btn-sm btn-primary">Editar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table Section End -->
            <nav class="hidden w-full mt-4 md:block">
                {{ $attentions->links() }}
            </nav>
            <nav class="w-full mt-4 sm:w-auto sm:mr-auto md:hidden">
                {{ $attentions->links('pagination::tailwind') }}
            </nav>
        @else
            <div class="p-10">
                <div class="mb-2 alert alert-secondary show" role="alert">
                    <div class="flex items-center">
                        <div class="text-lg font-medium">Aún no hay registros.</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Derives --}}
    <div class="{{ $show == 0 ? 'block' : 'hidden' }} intro-y">
        <h2 class="mr-auto text-lg font-medium">
            Derivaciones
        </h2>
        @if ($consultations->count())
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
                                    Paciente
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
                                        <p>
                                            {{ Staff::find($consultation->staff_id)->person->name }}
                                            {{ Staff::find($consultation->staff_id)->person->f_last_name }}
                                        </p>
                                        <div class="text-slate-500 text-xs mt-0.5">
                                            {{ Staff::find($consultation->staff_id)->department->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <p>
                                            {{ $consultation->patient->person->name }}
                                            {{ $consultation->patient->person->f_last_name }}
                                            {{ $consultation->patient->person->m_last_name }}
                                        </p>
                                    </td>
                                    <td>
                                        {{ $consultation->diagnostic }}
                                    </td>
                                    <td>
                                        <button wire:click="editDiagnosis('{{ $consultation->id }}')"
                                            @click="$wire.set('show', 1)"
                                            class="w-16 mb-2 btn btn-sm btn-primary">Ver</button>
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
                        <div class="text-lg font-medium">Aún no hay pacientes derivados a este módulo.</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Edit diagnosis --}}
    <div class="{{ $show == 1 ? 'block' : 'hidden' }} px-5 pt-5 intro-y">
        <div class="flex flex-col items-center mt-2 intro-y sm:flex-row">
            <h2 class="mr-auto text-lg font-medium">
                <span class="font-bold">Paciente: </span>

                @if ($consult)
                    {{ $consult->patient->person->name }}
                    {{ $consult->patient->person->f_last_name }}
                    {{ $consult->patient->person->m_last_name }}
                @endif
            </h2>
            <div class="flex w-full mt-4 sm:w-auto sm:mt-0">
                <button wire:click="resetVariables" @click="$wire.set('show', 0,)" class="mr-4 btn btn-danger h-10">
                    Atras
                </button>
                <div class="">
                    <button @click="attention = true" class="mb-2 mr-1 w-36 btn btn-primary">Nueva atención</button>
                </div>
                <div class="">
                    <button wire:click="changeStatus" @click="$wire.set('show', 0,)" class="mb-2 mr-1 btn
                        btn-primary">Marcar como tratado</button>
                </div>
            </div>
        </div>
        <div class="gap-5 mt-5 post intro-y">
            <!-- BEGIN: Post Content -->
            <div class="intro-y lg:col-span-8">
                <div class="mt-5 overflow-hidden post intro-y box">
                    <div class="post__content tab-content">
                        <div id="content" class="p-5 tab-pane active" role="tabpanel" aria-labelledby="content-tab">
                            <div class="p-5 border rounded-md border-slate-200/60 dark:border-darkmode-400">
                                <div
                                    class="flex items-center pb-5 font-medium border-b border-slate-200/60 dark:border-darkmode-400">
                                    Descripción
                                </div>
                                <textarea disabled wire:model="consultationDescription" class="form-control w-full h-40"></textarea>
                                <label for="regular-form-1" class="form-label">Diagnostico</label>
                                <input disabled wire:model="diagnostic" type="text" class="form-control"
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
                                                {{ substr($des[0][1], 0, 10) }}
                                            </td>
                                            <td>
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

    <!-- BEGIN: Modal create attention -->
    <div x-show="attention" :class="{ 'show': attention, '': !attention }" class="modal-personal" tabindex="-1"
        aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="attention = false">
                <div class="p-10 text-center modal-body">
                    <div class="mt-5">
                        <label>Descripción</label>
                        <div>
                            <textarea wire:model="description" class="w-full h-40"></textarea>
                            <x-jet-input-error for="description" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="attention = false">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="save" @click="Livewire.on('saved', () => { attention = false; } )"
                            class="mr-1 btn btn-primary">Guardar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Modal create attention -->

    <!-- BEGIN: Modal edit attention -->
    <div x-show="editAttention" :class="{ 'show': editAttention, '': !editAttention }" class="modal-personal"
        tabindex="-1" aria-hidden="true">
        <div class="mt-20 overflow-hidden modal-personal-dialog">
            <div class="modal-content" @click.away="editAttention = false, Livewire.emit('resetVariables')">
                <div class="p-10 text-center modal-body">
                    <div class="mt-5">
                        <label>Descripción</label>
                        <div>
                            <textarea wire:model="description" class="w-full h-40"></textarea>
                            <x-jet-input-error for="description" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <!-- BEGIN: Hide Modal Toggle -->
                        <button href="javascript:;" class="mr-1 btn btn-primary"
                            @click="editAttention = false, Livewire.emit('resetVariables')">Cerrar</button>
                        <!-- END: Hide Modal Toggle -->
                        <!-- BEGIN: Toggle Modal Toggle -->
                        <button wire:click="update('{{ $aux }}')"
                            @click="Livewire.on('saved', () => { editAttention = false; } )"
                            class="mr-1 btn btn-primary">Actualizar</button>
                        <!-- END: Toggle Modal Toggle -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN: Modal edit attention -->
</div>
