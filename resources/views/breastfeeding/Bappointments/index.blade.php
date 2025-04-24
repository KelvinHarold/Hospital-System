<x-breastfeeding-layout>
    <div x-data="{ openModal: false, selectedDoctor: null, resetForm: false }" class="p-6 bg-white rounded-lg shadow-lg max-w-6xl mx-auto">

        <!-- Header Section -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-blue-800 flex items-center justify-center">
                <i class='bx bx-calendar-check mr-3 text-blue-600 text-4xl'></i> 
                Available Doctors
            </h2>
            <p class="text-gray-600 mt-2">Select a doctor to book your consultation</p>
        </div>

        <!-- Doctors Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
            <table class="w-full text-left">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">
                            <i class='bx bx-user mr-2'></i> Name
                        </th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">
                            <i class='bx bx-envelope mr-2'></i> Email
                        </th>
                        <th class="py-4 px-6 font-semibold text-sm uppercase tracking-wider">
                            <i class='bx bx-calendar mr-2'></i> Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($doctors as $doctor)
                        <tr class="hover:bg-blue-50 transition-colors duration-150">
                            <td class="py-4 px-6 font-medium text-gray-900">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <i class='bx bx-user-circle text-blue-600 text-xl'></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $doctor->name }}</div>
                                        <div class="text-xs text-gray-500">Doctor</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-gray-700 text-sm">{{ $doctor->email }}</td>
                            <td class="py-4 px-6">
                                <button @click="openModal = true; selectedDoctor = {{ $doctor->id }}" 
                                    class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all shadow-sm hover:shadow-md">
                                    <i class='bx bx-calendar-plus mr-2'></i> Book Appointment
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-8 text-gray-600">
                                <i class='bx bx-info-circle text-3xl mb-2 text-blue-400'></i>
                                <p>No doctors available at this time.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Appointment Modal -->
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 p-4" 
             x-cloak>
            <div class="bg-white w-full max-w-md rounded-xl shadow-xl overflow-hidden transform transition-all">
                <!-- Modal Header -->
                <div class="bg-blue-600 p-5 text-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold flex items-center">
                            <i class='bx bx-calendar-check mr-2'></i> New Appointment
                        </h3>
                        <button @click="openModal = false" class="text-white hover:text-blue-200">
                            <i class='bx bx-x text-2xl'></i>
                        </button>
                    </div>
                    <p class="text-blue-100 text-sm mt-1">Fill the form to schedule your consultation</p>
                </div>
                
                <!-- Modal Body -->
                <form method="POST" action="{{ route('appointments.store') }}" 
                      @submit="resetForm = true; $nextTick(() => { resetForm = false })"
                      class="p-6 space-y-4 bg-white">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="doctor_id" :value="selectedDoctor">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Patient Name</label>
                            <div class="relative">
                                <input type="text" name="patient_name" required readonly
                                value="{{ auth()->user()->name }}"
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">                         
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Appointment Date</label>
                            <div class="relative">
                                <input type="datetime-local" name="appointment_date" required 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                                <i class='bx bx-calendar absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500'></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                            <div class="relative">
                                <textarea name="notes" rows="3"
                                          class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"></textarea>
                                <i class='bx bx-edit absolute left-3 top-4 text-gray-500'></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" @click="openModal = false" 
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-sm flex items-center">
                            <i class='bx bx-send mr-2'></i> Book Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            background: transparent;
            bottom: 0;
            color: transparent;
            cursor: pointer;
            height: auto;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            width: auto;
        }
    </style>
</x-breastfeeding-layout>