<x-Breastfeeding-layout>
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-2xl font-bold text-center mb-6">Health Record</h1>

        @if($breastfeedingDetails)
            <div class="overflow-x-auto bg-white shadow-md rounded p-6">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-4 py-2 border-b">Full Name</th>
                            <th class="px-4 py-2 border-b">Age</th>
                            <th class="px-4 py-2 border-b">Breastfeeding Stage</th>
                            <th class="px-4 py-2 border-b">Notes</th>
                            <th class="px-4 py-2 border-b">Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $breastfeedingDetails->full_name }}</td>
                            <td class="px-4 py-2 border-b">{{ $breastfeedingDetails->age }}</td>
                            <td class="px-4 py-2 border-b">{{ $breastfeedingDetails->breastfeeding_stage }}</td>
                            <td class="px-4 py-2 border-b">{{ $breastfeedingDetails->notes }}</td>
                            <td class="px-4 py-2 border-b">{{ $breastfeedingDetails->created_at->format('F j, Y g:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-red-500">No breastfeeding record found for the logged-in user.</p>
        @endif
    </div>
</x-Breastfeeding-layout>
