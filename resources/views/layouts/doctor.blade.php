<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
           <!-- Favicon (Logo) -->
           <link rel="icon" href="{{ asset('images/Logo.jpg') }}" type="image/jpg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.navigation')

    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /* Custom Colors */
        .icon-colored {
            color: #FE6700;
        }

        .hover-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .hover-link:hover {
            background-color: rgb(58, 137, 240);
            color: #FEFEFE;
        }

        .dropdown-link:hover {
            background-color: #0A061A;
            color: #FEFEFE;
        }
        
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
            <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark-mode:text-gray-200 dark-mode:bg-gray-800" x-data="{ open: false }">
                <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                    <a href="#" class="text-lg font-semibold tracking-widest text-blue-700 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">Doctor</a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
                    <x-doctor-links :href="route('doctor.index')" :active="request()->route('doctor.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                        <i class='bx bx-female mr-2 icon-colored'></i> Home
                    </x-doctor-links>     <x-doctor-links :href="route('doctor.pregnant.index')" :active="request()->route('doctor.pregnant.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                        <i class='bx bx-female mr-2 icon-colored'></i> Pregnant-Woman
                    </x-doctor-links>
                    <x-doctor-links :href="route('doctor.breastfeeding.index')" :active="request()->route('doctor.breastfeeding.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                        <i class='bx bx-female mr-2 icon-colored'></i> Breastfeeding-Woman
                    </x-doctor-links>
                    <x-doctor-links :href="route('doctor.children.index')" :active="request()->route('doctor.children.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                        <i class='bx bx-child mr-2 icon-colored'></i> Children
                    </x-doctor-links>

                    <x-doctor-links :href="route('doctor.appointments.index')" :active="request()->route('doctor.appointments.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                        <i class='bx bx-calendar mr-2 icon-colored'></i> Appointment
                    </x-doctor-links>

                    
                    <x-doctor-links :href="route('chats.index')" :active="request()->route('chats.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                        <i class='bx bx-chat mr-2 icon-colored'></i> Chats
                    </x-doctor-links>

                    <a href="{{ route('chat.index')}}" class="hover-link flex items-center px-4 py-2 mt-2 text-sm font-semibold rounded-lg">
                        <i class='bx bx-brain mr-2 icon-colored'></i> AI Assistant
                    </a>
                    

                    <x-admin-links 
                    :href="route('reports.index')" 
                    :active="request()->routeIs('reports.index')" 
                    class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline"              >
                    <i class='bx bx-file mr-2 icon-colored'></i> Reports
                </x-admin-links>
                

                    <!-- Dropdown User -->
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="hover-link flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
                            <i class='bx bx-user mr-2 icon-colored'></i>
                            <span>{{ Auth::user()->name }}</span>
                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg" onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class='bx bx-log-out mr-2 icon-colored'></i> {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                <a class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg" href="#">
                                    <i class='bx bx-link-alt mr-2 icon-colored'></i> Link #1
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="flex w-full bg-slate-50">
                <div class="p-4 w-full">
                    {{-- Show unread notifications --}}
                    @if(auth()->user()->unreadNotifications->count())
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-2 rounded shadow relative notification">
                                <button onclick="this.parentElement.remove()" 
                                        class="absolute top-1 right-2 text-yellow-700 font-bold hover:text-red-600">
                                    &times;
                                </button>
                                {{ $notification->data['message'] }} on {{ $notification->data['appointment_date'] }}
                            </div>
                        @endforeach
            
                        {{-- Mark them as read after displaying --}}
                        @php
                            auth()->user()->unreadNotifications->markAsRead();
                        @endphp
                    @endif
            
                    {{-- Main content of the page --}}
                    {{ $slot }}
                </div>
            </div>
            
        </div>

        @include('layouts.footer')
    </div>
</body>
</html>
