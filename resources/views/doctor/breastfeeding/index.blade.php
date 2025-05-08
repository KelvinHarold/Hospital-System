<x-doctor-layout>
    <div class="py-12 w-full">
        @include('components.success-message')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-center mb-6">
                <i class='bx bx-baby-carriage text-3xl mr-3 text-[#FE6700]'></i>
                <h1 class="text-3xl font-bold text-gray-800">Breastfeeding Women</h1>
            </div>
            
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class='bx bx-user mr-1'></i> Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <i class='bx bx-envelope mr-1'></i> Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($breastfeedings as $breastfeeding)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class='bx bx-user-circle mr-2 text-gray-400'></i>
                                        {{ $breastfeeding->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class='bx bx-envelope mr-2 text-gray-400'></i>
                                        {{ $breastfeeding->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('doctor.breastfeeding.create', ['user_id' => $breastfeeding->id]) }}" 
                                           class="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                                            <i class='bx bx-plus-medical mr-1'></i> Add Record
                                        </a>
                                        <a href="{{ route('doctor.breastfeeding.show', ['user_id' => $breastfeeding->id]) }}" 
                                           class="flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-md transition-colors duration-200">
                                            <i class='bx bx-show mr-1'></i> View
                                        </a>
                                        <a href="{{ route('doctor.children.create', ['mother_id' => $breastfeeding->id, 'mother_type' => 'breastfeeding-woman']) }}" 
                                           class="flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors duration-200">
                                            <i class='bx bx-plus mr-1'></i> Add Child
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-doctor-layout>