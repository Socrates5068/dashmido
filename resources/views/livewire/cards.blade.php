@php
use App\Models\Department;
use App\Models\Person;
@endphp
<div>
    <div class="container mt-10 overflow-hidden bg-white rounded-lg">
        <!-- component -->
        <!-- This is an example component -->
        <div class="max-w-2xl mx-auto mb-10">
            <h1 class="mt-10 text-xl font-medium intro-y">
                Mis fichas
            </h1>
            @if ($cards->count())
                <div class="relative mt-6 mb-6 overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Fecha
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Hora
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Médico
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Especialidad
                                </th>
                                {{-- <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cards as $card)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $card->date }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $card->time }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ Person::find($card->staff_id)->name }}
                                        {{ Person::find($card->staff_id)->f_last_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ Department::find($card->department_id)->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-10">
                    <div class="mb-2 alert alert-secondary show" role="alert">
                        <div class="flex items-center">
                            <div class="text-lg font-medium">Este paciente aún no tiene fichas
                                registradas.
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- {{ $cards->links() }} --}}
        </div>
    </div>
    @push('scripts')
        <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
    @endpush
</div>
