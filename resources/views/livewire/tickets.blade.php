<div>
    <div class="content">
        <div class="mb-5">
            <h2 class="intro-y text-lg font-medium mt-10">
                Fichajes
            </h2>
            <div class="mt-5">
                @foreach ($departments as $department)
                <button wire:click="tickets('{{ $department->name }}')" class="inline-flex items-center justify-center rounded-md bg-primary py-4 px-10 text-center text-base font-normal text-white hover:bg-opacity-90 lg:px-8 xl:px-10">
                    {{$department->name}}
                </button>
                @endforeach
            </div>
        </div>


        <!-- ====== Table Section Start -->
        <section class="bg-white py-20 lg:py-[120px]">
            <div class="container">
                <div class="-mx-4 flex flex-wrap">
                    <div class="w-full px-4">
                        <div class="max-w-full overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-primary text-center">
                                        <th class="w-1/6 min-w-[160px] border-l border-transparent py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                            Fecha
                                        </th>
                                        <th class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                            Hora
                                        </th>
                                        <th class="w-1/6 min-w-[160px] py-4 px-3 text-lg font-semibold text-white lg:py-7 lg:px-4">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="border-b border-l border-[#E8E8E8] bg-[#F3F6FF] py-5 px-2 text-center text-base font-medium text-dark">
                                            {{$ticket->date}}
                                        </td>
                                        <td class="border-b border-[#E8E8E8] bg-white py-5 px-2 text-center text-base font-medium text-dark">
                                            {{$ticket->time}}
                                        </td>
                                        <td class="border-b border-[#E8E8E8] bg-[#F3F6FF] py-5 px-2 text-center text-base font-medium text-dark">
                                            Reservar
                                        </td>
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
    </div>
</div>
