<x-pregnant-layout>
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mb-6">Health Record</h1>

        @if($pregnantDetails)
            <div class="overflow-x-auto bg-white shadow-md rounded p-6">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-4 py-2 border-b">Name</th>
                            <th class="px-4 py-2 border-b">Age</th>
                            <th class="px-4 py-2 border-b">Pregnancy_week</th>
                            <th class="px-4 py-2 border-b">Expected_delivery_date</th>
                            <th class="px-4 py-2 border-b">Health_conditions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $pregnantDetails->full_name }}</td>
                            <td class="px-4 py-2 border-b">{{ $pregnantDetails->age }}</td>
                            <td class="px-4 py-2 border-b">{{ $pregnantDetails->pregnancy_week }}</td>
                            <td class="px-4 py-2 border-b">{{ $pregnantDetails->expected_delivery_date }}</td>
                            <td class="px-4 py-2 border-b">{{ $pregnantDetails->health_conditions }}</td>
                            <td class="px-4 py-2 border-b">{{ $pregnantDetails->created_at->format('F j, Y g:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-red-500">No Pregnant record found for the logged-in user.</p>
        @endif
    </div>
</x-pregnant-layout>
