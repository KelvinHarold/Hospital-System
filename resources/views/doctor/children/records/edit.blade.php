<x-doctor-layout>
    <div class="max-w-2xl mx-auto mt-8 p-6 bg-white rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Edit Health Record</h2>

        <form method="POST" action="{{ route('doctor.children.records.update', $record->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block">Weight (kg)</label>
                <input type="number" name="weight" step="0.1" value="{{ $record->weight }}" required class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block">Height (cm)</label>
                <input type="number" name="height" step="0.1" value="{{ $record->height }}" required class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block">Head Circumference (cm)</label>
                <input type="number" name="head_circumference" step="0.1" value="{{ $record->head_circumference }}" required class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block">Notes</label>
                <textarea name="notes" class="w-full border p-2 rounded">{{ $record->notes }}</textarea>
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Update Record</button>
        </form>
    </div>
</x-doctor-layout>
