<div>
    <aside class="relative mb-20 overflow-hidden text-gray-300 bg-gray-100 lg:flex">
        <div class="w-full p-12 text-center lg:w-1/2 sm:p-16 lg:p-24 lg:text-left">
            <div class="max-w-xl mx-auto lg:ml-0">
                <p class="text-sm font-medium">Cuidamos lo más importante que tenemos.</p>

                <p class="mt-2 text-2xl font-bold text-teal-600 sm:text-3xl">
                    Clínica Vida y Salud
                </p>

                <p class="hidden text-teal-600 lg:mt-4 lg:block">
                    La Clínica Vida y Salud es un centro asistencial de alta complejidad con
                    actividad docente. Contamos con una moderna infraestructura, tecnología
                    médica de vanguardia y procesos eficientes implementados por un equipo de
                    trabajo multidisciplinario enfocado en el servicio, calidad y seguridad de
                    la atención médica.
                </p>

                {{-- <a href=""
                    class="inline-block px-5 py-3 mt-8 text-sm font-medium text-teal-600 bg-blue-500 rounded-lg hover:bg-blue-600">
                    Get started today
                </a> --}}
            </div>
        </div>

        <div class="relative w-full h-64 sm:h-96 lg:w-1/2 lg:h-auto">
            <img src="https://www.hyperui.dev/photos/women-2.jpeg" alt="Women smiling at college"
                class="absolute inset-0 object-cover w-full h-full" />
        </div>
    </aside>

    <hr>

    {{-- Especialidades --}}
    <section class="mb-10 text-teal-600 bg-gray-100">
        <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
            <div class="max-w-lg mx-auto text-center">
                <h2 class="text-3xl font-bold sm:text-4xl">Especialidades</h2>
            </div>

            <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3 ">
                @foreach ($departments as $department)
                    <a class="block p-8 transition bg-gray-900 border border-gray-800 shadow-xl rounded-xl hover:shadow-pink-500/10 hover:border-pink-500/10"
                        href="/services/digital-campaigns">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path
                                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>

                        <h3 class="mt-4 text-xl font-bold text-teal-600">{{ $department->name }}</h3>

                        <p class="mt-1 text-sm text-gray-300">
                            {{ $department->description }}
                        </p>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a class="inline-flex items-center px-8 py-3 mt-8 text-teal-600 bg-gray-900 border border-gray-900 rounded hover:bg-transparent active:text-gray-500 focus:outline-none focus:ring"
                    href="{{ route('tickets') }}">
                    <span class="text-sm font-medium"> Reserva tu hora </span>

                    <svg class="w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <hr>
    {{-- Contacto --}}
    <section>
        <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8 sm:py-24">
            <div class="max-w-3xl">
                <h2 class="text-3xl font-bold sm:text-4xl">
                    Encuentranos
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-8 mt-8 lg:gap-16 lg:grid-cols-2">
                <div class="relative h-64 overflow-hidden border-double sm:h-80 lg:h-full">
                    <img class="border rounded-lg" src="{{ asset('midone/dist/images/mapa.jpg') }}" alt="">
                </div>

                <div class="lg:py-16">
                    <article class="space-y-4 text-gray-600">
                        <p>
                            <span class="font-bold">Dirección: </span> Av. Arce #525 (entre Litoral y 1ro de abril)
                        </p>
                        <p>
                            <span class="font-bold">Teléfono: </span> 62-25482
                        </p>

                    </article>
                </div>
            </div>
        </div>
    </section>

    <hr>
</div>
