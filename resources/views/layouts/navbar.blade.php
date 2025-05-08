@role('doctor')
<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    <x-doctor-links :href="route('doctor.index')" :active="request()->route('doctor.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-home mr-2 icon-colored'></i> Home
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
@endrole

@role('admin')
<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    <x-admin-links :href="route('admin.roles.index')" :active="request()->route('admin.roles.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-shield-alt mr-2 icon-colored'></i> Roles
    </x-admin-links>
    <x-admin-links :href="route('admin.permissions.index')" :active="request()->route('admin.permissions.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-key mr-2 icon-colored'></i> Permissions
    </x-admin-links>
    <x-admin-links :href="route('admin.users.index')" :active="request()->route('admin.users.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-group mr-2 icon-colored'></i> Users
    </x-admin-links>
    <x-admin-links :href="route('admin.users.create')" :active="request()->route('admin.users.create')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-user-plus mr-2 icon-colored'></i> Add-User
    </x-admin-links>

    <x-admin-links 
    :href="route('reports.index')" 
    :active="request()->routeIs('reports.index')" 
    class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline"              >
    <i class='bx bx-file mr-2 icon-colored'></i> Reports
</x-admin-links>

    <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="hover-link flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
            <i class='bx bx-user mr-2 icon-colored'></i>
            <span>{{ Auth::user()->name }}</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                    class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg"
                            onclick="event.preventDefault();
                            
                                        this.closest('form').submit();">
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
@endrole

@role('pregnant-woman')
<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    <x-pregnant-links :href="route('breastfeeding.show')" :active="request()->route('breastfeeding.show')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-heart icon-colored'></i>Health-Record
    </x-pregnant-links>
    <x-pregnant-links :href="route('pregnant.show')" :active="request()->route('pregnant.show')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-child icon-colored"></i>Child-Record
    </x-pregnant-links> 
    <x-pregnant-links :href="route('appointments.index')" :active="request()->route('appointments.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-calendar icon-colored"></i>Appointment
    </x-pregnant-links>
    <x-pregnant-links :href="route('pregnant.index')" :active="request()->route('pregnant.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-alarm icon-colored"></i>Reminders
    </x-pregnant-links>
    <x-pregnant-links :href="route('pregnant.index')" :active="request()->route('pregnant.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-info-circle icon-colored"></i>Health-Tips
    </x-pregnant-links>
    <x-pregnant-links :href="route('chats.index')" :active="request()->route('chats.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-chat icon-colored"></i>Chats
    </x-pregnant-links>
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
@endrole

@role('breastfeeding-woman')
<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    <x-breastfeeding-links :href="route('breastfeeding.show')" :active="request()->route('breastfeeding.show')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-heart icon-colored"></i>Health-Record
    </x-breastfeeding-links>
    <x-breastfeeding-links :href="route('breastfeeding.child.show')" :active="request()->route('breastfeeding.child.show')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-child icon-colored"></i>Child-Record
    </x-breastfeeding-links>
    <x-breastfeeding-links :href="route('appointments.index')" :active="request()->route('appointments.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-calendar icon-colored"></i>Appointment
    </x-breastfeeding-links>
    <x-breastfeeding-links :href="route('feedback.index')" :active="request()->routeIs('feedback.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-comment icon-colored"></i>Feedback
    </x-breastfeeding-links>                        
    <x-breastfeeding-links :href="route('pregnant.index')" :active="request()->route('pregnant.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-alarm icon-colored"></i>Reminders
    </x-breastfeeding-links>
    <x-breastfeeding-links :href="route('pregnant.index')" :active="request()->route('pregnant.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-info-circle icon-colored"></i>Health-Tips
    </x-breastfeeding-links>
    <x-breastfeeding-links :href="route('chats.index')" :active="request()->route('chats.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class="bx bx-chat icon-colored"></i>Chats
    </x-breastfeeding-links>
    
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
@endrole

@role('organisation')
<nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto">
    <x-organisation-links :href="route('admin.roles.index')" :active="request()->route('admin.roles.index')" class="hover-link block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
        <i class='bx bx-shield-alt mr-2 icon-colored'></i> Roles
    </x-organisation-links>
    
    <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="hover-link flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg focus:outline-none focus:shadow-outline">
            <i class='bx bx-user mr-2 icon-colored'></i>
            <span>{{ Auth::user()->name }}</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
            <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                    class="dropdown-link block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg"
                            onclick="event.preventDefault();

                                        this.closest('form').submit();">
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
@endrole



