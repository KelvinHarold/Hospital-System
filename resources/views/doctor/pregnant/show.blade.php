<x-doctor-layout>
    <div class="container mx-auto px-4 py-6">
        @include('components.success-message')
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Pregnant Details</h2>

            @foreach ($records as $record)
                <table class="w-full text-left border-collapse mb-6">
                    <tr>
                        <td class="font-semibold px-4 py-2 border">Full Name</td>
                        <td class="px-4 py-2 border">{{ $record->full_name }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-4 py-2 border">Age</td>
                        <td class="px-4 py-2 border">{{ $record->age }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-4 py-2 border">Pregnancy Week</td>
                        <td class="px-4 py-2 border">{{ $record->pregnancy_week }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-4 py-2 border">Expected Delivery Date</td>
                        <td class="px-4 py-2 border">{{ $record->expected_delivery_date }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold px-4 py-2 border">Health Conditions</td>
                        <td class="px-4 py-2 border">{{ $record->health_conditions }}</td>
                    </tr>
                </table>

                <div class="flex justify-end gap-4 mb-8">
                    <a href="{{ route('doctor.pregnant.edit', $record->id) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded transition">
                        Edit
                    </a>

                    <form action="{{ route('doctor.pregnant.destroy', $record->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded transition">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach

        </div>
    </div>
</x-doctor-layout>
