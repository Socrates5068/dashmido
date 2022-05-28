@php
use App\Models\Department;
use App\Models\Person;
@endphp
<div>
    <x-notification-message-frontend on="save" time="9000">
        <div @click.outside="shown = false"
            class="shadow-lg h-56 mr-8 mt-8 fixed top-0 right-0 w-full max-w-[700px] rounded-[20px] bg-white py-8 px-8 text-center md:py-[14px] md:px-[70px]">
            <h3 class="pb-2 text-xl font-bold text-dark sm:text-2xl">
                Su ficha a sido reservada satisfactoriamente.
            </h3>
            <span class="mx-auto mb-4 inline-block h-1 w-[90px] rounded bg-primary"></span>
            <p class="mb-6 text-base leading-relaxed text-body-color">
                Puede reservar una ficha para otra especialidad o puede ver todas sus fichas reservadas en el
                siguiente enlace a continuación.
            </p>
            <div class="flex flex-wrap -mx-3">
                <div class="w-1/2 px-3">
                    <button @click="shown = false"
                        class="block w-full rounded-lg border border-[#E9EDF9] p-3 text-center text-base font-medium text-dark transition hover:border-red-600 hover:bg-red-600 hover:text-white">
                        Cerrar
                    </button>
                </div>
                <div class="w-1/2 px-3">
                    <a href="{{ route('cards') }}"
                        class="block w-full p-3 text-base font-medium text-center text-white transition border rounded-lg border-primary bg-primary hover:bg-opacity-90">
                        Ver fichas
                    </a>
                </div>
            </div>
        </div>
    </x-notification-message-frontend>

    <div class="content">
        <div class="mb-5">
            @if ($tickets->count())
                @php
                    $title = $tickets->first()->department_id;
                @endphp
            @endif
            <h2 class="mt-10 text-lg font-medium intro-y">
                Fichajes
            </h2>
            <div class="mt-5">
                @if ($tickets->count())
                    @foreach ($departments as $department)
                        @if ($department->name !== 'Administración' && $department->name !== 'Enfermería')
                            <button wire:click="tickets('{{ $department->id }}')"
                                class="{{ $tickets->first()->department_id == $department->id ? 'bg-green-600' : 'bg-primary' }} inline-flex items-center justify-center rounded-md  py-4 px-10 text-center text-base font-normal text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                                {{ $department->name }}
                            </button>
                        @endif
                    @endforeach
                @else
                    @foreach ($departments as $department)
                        @if ($department->name !== 'Administración' && $department->name !== 'Enfermería')
                            <button wire:click="tickets('{{ $department->id }}')"
                                class="inline-flex items-center justify-center px-10 py-4 text-base font-normal text-center text-white rounded-md bg-primary hover:bg-opacity-90 lg:px-8 xl:px-10">
                                {{ $department->name }}
                            </button>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>

        @if ($tickets->count())
            <!-- ====== Table Section Start -->
            <section class="py-5 bg-white">
                <h2 class="mb-8 text-3xl font-bold ml-14 text-dark sm:text-4xl">
                    {{ Department::find($title)->name }}
                </h2>
                <div class="container">
                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full px-4">
                            <div class="max-w-full overflow-x-auto">
                                <table class="w-full table-auto">
                                    <thead>
                                        <tr class="text-center bg-primary">
                                            <th
                                                class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                                Médico
                                            </th>
                                            <th
                                                class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                                Fecha
                                            </th>
                                            <th
                                                class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                                Hora
                                            </th>
                                            <th
                                                class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                                Estado
                                            </th>
                                            <th
                                                class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td
                                                    class="border-b border-l border-[#E8E8E8] bg-[#F3F6FF] py-5 px-2 text-center text-base font-medium text-dark">
                                                    <span class="block mb-2 text-lg font-semibold text-primary">
                                                        {{ Person::find($ticket->doctor_id)->name }}
                                                        {{ Person::find($ticket->doctor_id)->f_last_name }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="border-b border-[#E8E8E8] bg-white py-5 px-2 text-center text-base font-medium text-dark">
                                                    {{ $ticket->date }}
                                                </td>
                                                <td
                                                    class="border-b border-l border-[#E8E8E8] bg-[#F3F6FF] py-5 px-2 text-center text-base font-medium text-dark">
                                                    {{ $ticket->time }}
                                                </td>
                                                @if ($ticket->status == '0')
                                                    <td
                                                        class="border-b border-[#E8E8E8] bg-white py-5 px-2 text-center text-base font-bold text-green-700">
                                                        <span
                                                            class="inline-block px-3 py-1 m-2 text-sm font-semibold text-white rounded-full bg-success">
                                                            Sin reservar
                                                        </span>
                                                    </td>
                                                @else
                                                    <td
                                                        class="border-b border-[#E8E8E8] bg-white py-5 px-2 text-center text-base font-medium text-dark">
                                                        <span
                                                            class="inline-block px-3 py-1 m-2 text-sm font-semibold text-white rounded-full bg-danger">
                                                            Reservado
                                                        </span>
                                                    </td>
                                                @endif
                                                @if (auth()->user()->status == 0)
                                                    <td
                                                        class="border-b border-[#E8E8E8] bg-[#F3F6FF] py-5 px-2 text-center text-base font-medium text-dark">
                                                        <span wire:click="book('{{ $ticket->id }}')"
                                                            class="inline-block px-2 py-1 m-2 text-sm font-semibold text-white rounded cursor-pointer bg-primary">
                                                            Reservar
                                                        </span>
                                                    </td>
                                                @else
                                                    <td
                                                        class="border-b border-[#E8E8E8] bg-[#F3F6FF] py-5 px-2 text-center text-base font-medium text-dark">
                                                        <span
                                                            class="inline-block px-2 py-1 m-2 text-sm font-semibold text-white bg-gray-600 rounded">
                                                            Reservar
                                                        </span>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ====== Table Section End -->
        @else
            <div
                class="max-w-xl mb-11 flex rounded-lg border-l-[6px] border-warning bg-warning bg-opacity-[15%] px-7 py-8 shadow-md md:p-9">
                <div
                    class="mr-5 flex h-9 w-full max-w-[36px] items-center justify-center rounded-lg bg-warning bg-opacity-30">
                    <svg width="19" height="16" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.50493 16H17.5023C18.6204 16 19.3413 14.9018 18.8354 13.9735L10.8367 0.770573C10.2852 -0.256858 8.70677 -0.256858 8.15528 0.770573L0.156617 13.9735C-0.334072 14.8998 0.386764 16 1.50493 16ZM10.7585 12.9298C10.7585 13.6155 10.2223 14.1433 9.45583 14.1433C8.6894 14.1433 8.15311 13.6155 8.15311 12.9298V12.9015C8.15311 12.2159 8.6894 11.688 9.45583 11.688C10.2223 11.688 10.7585 12.2159 10.7585 12.9015V12.9298ZM8.75236 4.01062H10.2548C10.6674 4.01062 10.9127 4.33826 10.8671 4.75288L10.2071 10.1186C10.1615 10.5049 9.88572 10.7455 9.50142 10.7455C9.11929 10.7455 8.84138 10.5028 8.79579 10.1186L8.13574 4.75288C8.09449 4.33826 8.33984 4.01062 8.75236 4.01062Z"
                            fill="#FBBF24" />
                    </svg>
                </div>
                <div class="w-full">
                    <h5 class="mb-3 text-lg font-semibold text-[#9D5425]">
                        No hay fichas para reservar, comuniquese con un administrador.
                    </h5>
                </div>
            </div>
        @endif
    </div>
</div>
