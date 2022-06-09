<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="hidden mr-auto -intro-x sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{ $application }}</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $content1 }}</li>
            @isset($content2)
            <li class="breadcrumb-item active" aria-current="page">{{ $content2 }}</li>
            @endisset
            @isset($content3)
            <li class="breadcrumb-item active" aria-current="page">{{ $content3 }}</li>
            @endisset
            @isset($content4)
            <li class="breadcrumb-item active" aria-current="page">{{ $content4 }}</li>
            @endisset
        </ol>
    </nav>
    <!-- END: Breadcrumb -->

    <!-- BEGIN: Search -->
    <div x-data="{ message: '' }" class="relative mr-3 intro-x sm:mr-6">
        <div class="search sm:block">
            <input type="text" class="hidden border-transparent md:block search__input form-control" placeholder="Buscar..." x-model="message" @input="Livewire.emit('updateSearch', message)">

            <input type="text" class="border-transparent md:hidden form-control" placeholder="Buscar..." x-model="message" @input="Livewire.emit('updateSearch', message)">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        {{-- <a class="notification sm:hidden" href=""> <i data-lucide="search"
                class="notification__icon dark:text-slate-500"></i> </a> --}}
        {{-- <div class="search-result">
            <div class="search-result__content">
                <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="" class="flex items-center">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-success/20 dark:bg-success/10 text-success">
                            <i class="w-4 h-4" data-lucide="inbox"></i> </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-pending/10 text-pending">
                            <i class="w-4 h-4" data-lucide="users"></i> </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-primary/10 dark:bg-primary/20 text-primary/80">
                            <i class="w-4 h-4" data-lucide="credit-card"></i> </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full"
                                src="dist/images/profile-6.jpg">
                        </div>
                        <div class="ml-3">Angelina Jolie</div>
                        <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">angelinajolie@left4code.com
                        </div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full"
                                src="dist/images/profile-5.jpg">
                        </div>
                        <div class="ml-3">Leonardo DiCaprio</div>
                        <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">
                            leonardodicaprio@left4code.com</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full"
                                src="dist/images/profile-5.jpg">
                        </div>
                        <div class="ml-3">Johnny Depp</div>
                        <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">johnnydepp@left4code.com
                        </div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full"
                                src="dist/images/profile-4.jpg">
                        </div>
                        <div class="ml-3">Denzel Washington</div>
                        <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">
                            denzelwashington@left4code.com</div>
                    </a>
                </div>
                <div class="search-result__content__title">Products</div>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-5.jpg">
                    </div>
                    <div class="ml-3">Nike Air Max 270</div>
                    <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">Sport &amp; Outdoor</div>
                </a>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-3.jpg">
                    </div>
                    <div class="ml-3">Sony A7 III</div>
                    <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">Photography</div>
                </a>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-15.jpg">
                    </div>
                    <div class="ml-3">Samsung Q90 QLED TV</div>
                    <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">Electronic</div>
                </a>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/preview-2.jpg">
                    </div>
                    <div class="ml-3">Nike Tanjun</div>
                    <div class="w-48 ml-auto text-xs text-right truncate text-slate-500">Sport &amp; Outdoor</div>
                </a>
            </div>
        </div> --}}
    </div>
    <!-- END: Search -->

    <!-- BEGIN: Notifications -->
    <div class="mr-auto intro-x dropdown sm:mr-6">
        <div class="cursor-pointer dropdown-toggle notification notification--bullet" role="button" aria-expanded="false" data-tw-toggle="dropdown"> <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg></div>
        
        {{-- <div class="pt-2 notification-content dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notifications</div>
                <div class="relative flex items-center cursor-pointer ">
                    <div class="flex-none w-12 h-12 mr-1 image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-5.jpg">
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-success dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="mr-5 font-medium truncate">Arnold
                                Schwarzenegger</a>
                            <div class="ml-auto text-xs text-slate-400 whitespace-nowrap">03:20 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact
                            that a reader will be distracted by the readable content of a page when looking
                            at its layout. The point of using Lorem </div>
                    </div>
                </div>
                <div class="relative flex items-center mt-5 cursor-pointer">
                    <div class="flex-none w-12 h-12 mr-1 image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-4.jpg">
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-success dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="mr-5 font-medium truncate">Kevin Spacey</a>
                            <div class="ml-auto text-xs text-slate-400 whitespace-nowrap">06:05 AM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of
                            passages of Lorem Ipsum available, but the majority have suffered alteration in
                            some form, by injected humour, or randomi</div>
                    </div>
                </div>
                <div class="relative flex items-center mt-5 cursor-pointer">
                    <div class="flex-none w-12 h-12 mr-1 image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-3.jpg">
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-success dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="mr-5 font-medium truncate">Kevin Spacey</a>
                            <div class="ml-auto text-xs text-slate-400 whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">Lorem Ipsum is simply dummy text
                            of the printing and typesetting industry. Lorem Ipsum has been the
                            industry&#039;s standard dummy text ever since the 1500</div>
                    </div>
                </div>
                <div class="relative flex items-center mt-5 cursor-pointer">
                    <div class="flex-none w-12 h-12 mr-1 image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-10.jpg">
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-success dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="mr-5 font-medium truncate">Keanu Reeves</a>
                            <div class="ml-auto text-xs text-slate-400 whitespace-nowrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact
                            that a reader will be distracted by the readable content of a page when looking
                            at its layout. The point of using Lorem </div>
                    </div>
                </div>
                <div class="relative flex items-center mt-5 cursor-pointer">
                    <div class="flex-none w-12 h-12 mr-1 image-fit">
                        <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                            src="dist/images/profile-6.jpg">
                        <div
                            class="absolute bottom-0 right-0 w-3 h-3 border-2 border-white rounded-full bg-success dark:border-darkmode-600">
                        </div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="mr-5 font-medium truncate">John Travolta</a>
                            <div class="ml-auto text-xs text-slate-400 whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of
                            passages of Lorem Ipsum available, but the majority have suffered alteration in
                            some form, by injected humour, or randomi</div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- END: Notifications -->

    <!-- BEGIN: Account Menu -->
    {{-- <div class="w-8 h-8 intro-x dropdown">
        <div class="w-8 h-8 overflow-hidden rounded-full shadow-lg dropdown-toggle image-fit zoom-in"
            role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="Rubick Tailwind HTML Admin Template" src="{{asset('midone/dist/images/profile-8.jpg')}}">
</div>
<div class="w-56 dropdown-menu">
    <ul class="text-white dropdown-content bg-primary">
        <li class="p-2">
            <div class="font-medium">Arnold Schwarzenegger</div>
            <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">Frontend Engineer</div>
        </li>
        <li>
            <hr class="dropdown-divider border-white/[0.08]">
        </li>
        <li>
            <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
        </li>
        <li>
            <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
        </li>
        <li>
            <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
        </li>
        <li>
            <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
        </li>
        <li>
            <hr class="dropdown-divider border-white/[0.08]">
        </li>
        <li>
            <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
        </li>
    </ul>
</div>
</div> --}}
<!-- Settings Dropdown -->
<div class="relative">
    <x-jet-dropdown align="right" width="48">
        <x-slot name="trigger">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
            </button>
            @else
            <span class="inline-flex rounded-md">
                <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                    {{ Auth::user()->name }}

                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </span>
            @endif
        </x-slot>

        <x-slot name="content">
            <!-- Account Management -->
            <div class="block px-4 py-2 text-xs text-gray-400">
                <a href="" class="font-medium">{{ Auth::user()->name }}</a>
                <div class="text-slate-500 text-xs mt-0.5">{{ Auth::user()->getRoleNames()->first() }}</div>
            </div>

            <div class="border-t border-gray-100"></div>

            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </x-jet-dropdown-link>

            <div class="border-t border-gray-100"></div>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf

                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </form>
        </x-slot>
    </x-jet-dropdown>
</div>
<!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
