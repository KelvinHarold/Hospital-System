<x-admin-layout>
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-xl border border-gray-200 shadow-md">
        <div class="flex items-center mb-6">
            <i class='bx bx-user-plus text-2xl mr-2 text-[#FE6700]'></i>
            <h2 class="text-2xl font-semibold">Register New User</h2>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500" 
                            placeholder="John Doe"
                            required>
                        <i class='bx bx-user absolute left-3 top-3 text-gray-400'></i>
                    </div>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <div class="relative">
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500" 
                            placeholder="example@email.com"
                            required>
                        <i class='bx bx-envelope absolute left-3 top-3 text-gray-400'></i>
                    </div>
                </div>

                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <div class="relative">
                        <input 
                            type="tel" 
                            name="phone" 
                            id="phone" 
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500" 
                            placeholder="+255..."
                            required>
                        <i class='bx bx-phone absolute left-3 top-3 text-gray-400'></i>
                    </div>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit" class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow-sm flex items-center">
                    <i class='bx bx-user-plus mr-2'></i> Register User
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
