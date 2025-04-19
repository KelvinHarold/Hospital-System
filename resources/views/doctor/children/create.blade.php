<x-doctor-layout>
    <div class="py-12 max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-center mb-6">Add Child</h2>
        <form method="POST" action="{{ route('doctor.children.store') }}" class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf
            <input type="hidden" name="mother_id" value="{{ $mother_id }}">
            <input type="hidden" name="mother_type" value="{{ $mother_type }}">

            <div>
                <label class="block font-medium">Child Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Birth Date</label>
                <input type="date" name="birth_date" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Weight (kg)</label>
                <input type="number" step="0.01" name="weight" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Height (cm)</label>
                <input type="number" step="0.1" name="height" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Head Circumference (cm)</label>
                <input type="number" step="0.1" name="head_circumference" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Notes</label>
                <textarea name="notes" class="w-full border p-2 rounded" rows="3"></textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save Child</button>
        </form>
    </div>
</x-doctor-layout>
