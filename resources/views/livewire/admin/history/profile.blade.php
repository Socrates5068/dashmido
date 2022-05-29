<div>
    @push('styles')
        <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    @endpush
    <!-- BEGIN: Profile Info -->
    <div class="px-5 pt-5 mt-5 intro-y box">
        <div class="flex flex-col pb-5 -mx-5 border-b lg:flex-row border-slate-200/60 dark:border-darkmode-400">
            <div class="flex items-center justify-center flex-1 px-5 lg:justify-start">
                <div class="relative flex-none w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit">
                    <img alt="Midone - HTML Admin Template" class="rounded-full"
                        src="{{ $person->user->profile_photo_url }}">
                </div>
                <div class="ml-5">
                    <div class="w-24 text-lg font-medium truncate sm:w-40 sm:whitespace-normal">{{ $person->name }}
                    </div>
                    <div class="text-slate-500">{{ $person->f_last_name }} {{ $person->m_last_name }}</div>
                    <div class="w-24 text-lg font-medium truncate sm:w-40 sm:whitespace-normal">{{ $person->patient->old . ' años' }}
                    </div>
                </div>
            </div>
            <div
                class="flex-1 px-5 pt-5 mt-6 border-t border-l border-r lg:mt-0 border-slate-200/60 dark:border-darkmode-400 lg:border-t-0 lg:pt-0">
                <div class="font-medium text-center lg:text-left lg:mt-3">Información</div>
                <div class="flex flex-col items-center justify-center mt-4 prose lg:items-start">
                    <div class="flex items-center truncate sm:whitespace-normal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="m-1 font-bold"> Dirección: </span> {{ $person->address }}
                    </div>
                    <div class="flex items-center mt-3 truncate sm:whitespace-normal"> <svg
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg> <span class="m-1 font-bold"> Teléfono: </span> {{ $person->telephone }} </div>
                    <div class="flex items-center mt-3 truncate sm:whitespace-normal"> <svg
                            xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> <span class="m-1 font-bold"> Sexo: </span> {{ $person->sex }} </div>
                </div>
            </div>
            <div
                class="flex items-center justify-center flex-1 px-5 pt-5 mt-6 border-t lg:mt-0 lg:border-0 border-slate-200/60 dark:border-darkmode-400 lg:pt-0">
                <div class="w-20 py-3 text-center rounded-md">
                    <div class="text-xl font-medium text-primary">201</div>
                    <div class="text-slate-500">Orders</div>
                </div>
                <div class="w-20 py-3 text-center rounded-md">
                    <div class="text-xl font-medium text-primary">1k</div>
                    <div class="text-slate-500">Purchases</div>
                </div>
                <div class="w-20 py-3 text-center rounded-md">
                    <div class="text-xl font-medium text-primary">492</div>
                    <div class="text-slate-500">Reviews</div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Profile Info -->
</div>
