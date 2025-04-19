<!-- filepath: c:\xampp\htdocs\Myproject\mtotoclinic\resources\views\admin\roles\index.blade.php -->
<x-doctor-layout>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Children's Records</h1>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <i class="bx bx-child text-gray-500 mr-2"></i> Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($childs as $child)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $child->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex justify-end space-x-4">
                                        <!-- Add Record Button -->
                                        <a href="{{ route('doctor.children.records.create', $child->id) }}"
                                           class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md flex items-center">
                                           <i class="bx bx-plus-circle mr-2"></i> Add Record
                                        </a>
                                        <!-- View Button -->
                                        <a href="{{ route('doctor.children.records.show', $child->id) }}"
                                           class="px-4 py-2 bg-orange-500 hover:bg-orange-700 text-white rounded-md flex items-center">
                                           <i class="bx bx-eye mr-2"></i> View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination (if needed) -->
            </div>
        </div>
    </div>
</x-doctor-layout>
