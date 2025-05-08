<x-doctor-layout>
    <div class="max-w-6xl mx-auto py-10">
        @include('components.success-message')
        <div class="flex items-center justify-center mb-6">
            <i class='bx bx-baby-carriage text-3xl mr-3 text-[#FE6700]'></i>
            <h2 class="text-3xl font-bold text-gray-800">Breastfeeding Records for {{ $user->name }}</h2>
        </div>

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-user mr-1'></i> Full Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-calendar-alt mr-1'></i> Age
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-stats mr-1'></i> Stage
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class='bx bx-note mr-1'></i> Notes
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($records as $record)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <i class='bx bx-user-circle mr-2 text-gray-400'></i>
                                    {{ $record->full_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->age }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $record->breastfeeding_stage }}</td>
                            <td class="px-6 py-4">{{ $record->notes ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('doctor.breastfeeding.edit', $record->id) }}" 
                                       class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                                        <i class='bx bx-edit mr-1'></i> Edit
                                    </a>
                                    <form action="{{ route('doctor.breastfeeding.destroy', $record->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')" 
                                                class="flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors duration-200">
                                            <i class='bx bx-trash mr-1'></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <i class='bx bx-info-circle mr-1'></i> No breastfeeding records found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-doctor-layout>