<x-doctor-layout>
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white shadow-xl rounded-xl border border-gray-200">
        <div class="flex items-center justify-center mb-6">
            <i class='bx bx-edit-alt text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold text-gray-800">Edit Pregnant Woman Details</h2>
        </div>

        <form action="{{ route('doctor.pregnant.update', $pregnant->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-user mr-2 text-[#FE6700]'></i> Full Name
                </label>
                <input 
                    type="text" 
                    name="full_name" 
                    value="{{ old('full_name', $pregnant->full_name) }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                    required
                >
                <i class='bx bx-user absolute left-3 top-10 text-gray-400'></i>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-calendar-alt mr-2 text-[#FE6700]'></i> Age
                    </label>
                    <input 
                        type="number" 
                        name="age" 
                        value="{{ old('age', $pregnant->age) }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                        required
                    >
                    <i class='bx bx-calendar-alt absolute left-3 top-10 text-gray-400'></i>
                </div>

                <div class="relative">
                    <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                        <i class='bx bx-calendar-week mr-2 text-[#FE6700]'></i> Pregnancy Week
                    </label>
                    <input 
                        type="number" 
                        name="pregnancy_week" 
                        value="{{ old('pregnancy_week', $pregnant->pregnancy_week) }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                        required
                    >
                    <i class='bx bx-calendar-week absolute left-3 top-10 text-gray-400'></i>
                </div>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-calendar-event mr-2 text-[#FE6700]'></i> Expected Delivery Date
                </label>
                <input 
                    type="date" 
                    name="expected_delivery_date" 
                    value="{{ old('expected_delivery_date', $pregnant->expected_delivery_date) }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200" 
                    required
                >
                <i class='bx bx-calendar-event absolute left-3 top-10 text-gray-400'></i>
            </div>

            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                    <i class='bx bx-heart mr-2 text-[#FE6700]'></i> Health Conditions
                </label>
                <textarea 
                    name="health_conditions" 
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-200"
                >{{ old('health_conditions', $pregnant->health_conditions) }}</textarea>
            </div>

            <div class="flex justify-end gap-4 pt-4">
                <a href="{{ route('doctor.pregnant.show', $pregnant->id) }}"
                    class="flex items-center px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                    <i class='bx bx-x mr-2'></i> Cancel
                </a>
                <button type="submit"
                    class="flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-md">
                    <i class='bx bx-save mr-2'></i> Update
                </button>
            </div>
        </form>
    </div>
</x-doctor-layout>