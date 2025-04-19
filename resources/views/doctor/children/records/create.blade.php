<x-doctor-layout>
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <div class="text-center mb-6">
            <i class='bx bx-medical mr-2 text-blue-500 text-3xl'></i>
            <h2 class="text-2xl font-bold text-gray-800">Add Health Record for {{ $child->name }}</h2>
        </div>

        <form method="POST" action="{{ route('doctor.children.records.store') }}">
            @csrf
            <input type="hidden" name="child_id" value="{{ $child->id }}">

            <!-- Weight -->
            <div class="mb-4 relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                <input 
                    type="number" 
                    step="0.1" 
                    name="weight" 
                    required 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    placeholder="Enter weight in kg"
                >
                <i class="bx bx-weight absolute left-3 top-10 text-gray-400"></i>
            </div>

            <!-- Height -->
            <div class="mb-4 relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">Height (cm)</label>
                <input 
                    type="number" 
                    step="0.1" 
                    name="height" 
                    required 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    placeholder="Enter height in cm"
                >
                <i class="bx bx-ruler absolute left-3 top-10 text-gray-400"></i>
            </div>

            <!-- Head Circumference -->
            <div class="mb-4 relative">
                <label class="block text-sm font-medium text-gray-700 mb-2">Head Circumference (cm)</label>
                <input 
                    type="number" 
                    step="0.1" 
                    name="head_circumference" 
                    required 
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                    placeholder="Enter head circumference in cm"
                >
                <i class="bx bx-brain absolute left-3 top-10 text-gray-400"></i>
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea 
                    name="notes" 
                    rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200" 
                    placeholder="Enter any additional notes here"
                ></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-200">
                <i class='bx bx-save mr-2'></i> Save Record
            </button>
        </form>
    </div>
</x-doctor-layout>
