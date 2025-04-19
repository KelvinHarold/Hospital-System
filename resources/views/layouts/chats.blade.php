<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom Colors */
        .icon-colored {
            color: #FE6700;
        }
        .hover-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .hover-link:hover {
            background-color: #4D1489;
            color: #FEFEFE;
        }
        .dropdown-link:hover {
            background-color: #0A061A;
            color: #FEFEFE;
        }
        /* Added styles for better layout */
        .main-container {
            display: flex;
            min-height: 100vh;
            max-height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 280px;
            flex-shrink: 0;
            border-right: 1px solid #e5e7eb;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
        }
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .chat-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: fixed;
                z-index: 40;
                height: 100vh;
            }
            .sidebar.collapsed {
                display: none;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="main-container">
        <!-- Sidebar -->
        <div 
            @click.away="open = false" 
            class="sidebar" 
            x-data="{ open: false }"
            :class="{'collapsed': !open}"
        >
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <a href="#" class="text-xl font-bold text-gray-900 tracking-wider">CHATS</a>
                <button 
                    class="md:hidden rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-200"
                    @click="open = !open"
                >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
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

        <!-- Main Content -->
        <div class="content-area">
            <div class="chat-container">
                {{ $slot }}
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
