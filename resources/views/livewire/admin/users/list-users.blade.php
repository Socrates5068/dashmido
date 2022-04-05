<div>
    <h2 class="intro-y text-lg font-medium mt-10">
        Usuarios
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="">
                <button class="btn btn-primary shadow-md mr-2">Agregar nuevo usuario</button>
            </a>
            <div class="dropdown">
                <button wire:ignore class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4"
                            data-feather="plus"></i> </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="users" class="w-4 h-4 mr-2"></i> Add
                                Group </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="message-circle"
                                    class="w-4 h-4 mr-2"></i> Send Message </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">{{ $users->links('pagination::message') }}</div>
            <div x-data="{ message: '' }" class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Buscar..." x-model="message"
                        @input="Livewire.emit('updateSearch', message)">
                    <i class=" w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @foreach ($users as $user)
            <div class="intro-y col-span-12 md:col-span-6">
                <div class="box">
                    <div class="flex flex-col lg:flex-row items-center p-5">
                        <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                                src="{{ $user->profile_photo_url }}">
                        </div>
                        <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $user->name }}</a>
                            <div class="text-slate-500 text-xs mt-0.5">Software Engineer</div>
                        </div>
                        <div class="flex mt-4 lg:mt-0">
                            <button class="btn btn-primary py-1 px-2 mr-2">Message</button>
                            <button class="btn btn-outline-secondary py-1 px-2">Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- BEGIN: Users Layout -->
        <!-- END: Pagination -->

        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full hidden md:block">
                {{ $users->links() }}
            </nav>
            <nav class="w-full sm:w-auto sm:mr-auto md:hidden">
                {{ $users->links('pagination::tailwind') }}
            </nav>
            <select wire:model="paginate" class="w-20 form-select box mt-3 sm:mt-0">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="35">35</option>
                <option value="50">50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>
</div>
