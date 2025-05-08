<x-doctor-layout>
    <div class="container mx-auto py-8" x-data="{ showModal: false, appointmentId: null, message: '' }">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-xl rounded-lg">
                <div class="bg-blue-600 text-white text-center rounded-t-lg py-4">
                    <h3 class="text-2xl font-semibold">My Appointments</h3>
                </div>
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 text-green-600 font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($appointments->isEmpty())
                        <div class="text-center text-gray-500">
                            No appointments found.
                        </div>
                    @else
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="border-b text-gray-700 bg-gray-100">
                                    <th class="px-4 py-3 text-left">Patient Name</th>
                                    <th class="px-4 py-3 text-left">Appointment Date</th>
                                    <th class="px-4 py-3 text-left">Notes</th>
                                    <th class="px-4 py-3 text-left">Feedback</th>
                                    <th class="px-4 py-3 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="px-4 py-3">{{ $appointment->patient_name }}</td>
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y - H:i') }}
                                        </td>
                                        <td class="px-4 py-3">{{ $appointment->notes }}</td>
                                        <td class="px-4 py-3">
                                            <button 
                                                @click="showModal = true; appointmentId = {{ $appointment->id }}; message = `{{ $appointment->notes }}`"
                                                class="text-blue-500 hover:text-blue-700 font-semibold">
                                                Give Feedback
                                            </button>
                                        </td>
                                        <td>
                                            <form action="{{ route('doctor.appointment.delete', $appointment->id) }}" method="POST" 
                                                class="flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition-colors duration-200">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="flex items-center">
                                                  <i class='bx bx-trash mr-1'></i> Delete
                                              </button>
                                          </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <!-- Feedback Modal -->
        <div 
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            x-show="showModal" 
            x-cloak>
            <div class="bg-white p-6 rounded shadow-md w-full max-w-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Give Feedback</h2>
                <form method="POST" action="{{ route('feedback.store') }}">
                    @csrf
                    <input type="hidden" name="appointment_id" :value="appointmentId">
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Message</label>
                        <textarea name="message" class="w-full p-2 border border-gray-300 rounded" x-text="message" readonly></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <div class="relative">
                            <select name="status" 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    
                            <i class='bx bx-list-check absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500'></i>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Reply</label>
                        <textarea name="reply" class="w-full p-2 border border-gray-300 rounded" placeholder="Type your reply..." required></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Submit</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</x-doctor-layout>
