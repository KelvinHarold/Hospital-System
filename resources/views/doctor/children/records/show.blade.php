<x-doctor-layout>
    <div class="max-w-6xl mx-auto py-8">
        <h2 class="text-2xl font-bold mb-4">
            Health Records for {{ $child->name }} <br>
            <span class="text-sm font-normal">Mother: {{ $child->user->name }}</span>
        </h2>
        

        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Weight (kg)</th>
                    <th class="p-3 text-left">Height (cm)</th>
                    <th class="p-3 text-left">Head Circumference (cm)</th>
                    <th class="p-3 text-left">Notes</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($child->records as $record)
                    <tr class="border-t">
                        <td class="p-3">{{ $record->record_date }}</td>
                        <td class="p-3">{{ $record->weight }}</td>
                        <td class="p-3">{{ $record->height }}</td>
                        <td class="p-3">{{ $record->head_circumference }}</td>
                        <td class="p-3">{{ $record->notes }}</td>
                        <td class="p-3 flex space-x-2">
                            <a href="{{ route('doctor.children.records.edit', $record->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Edit</a>
                            <form action="{{ route('doctor.children.records.destroy', $record->id) }}" method="POST" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if ($child->records->isEmpty())
                    <tr><td colspan="6" class="p-3 text-center text-gray-500">No records found.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
</x-doctor-layout>
