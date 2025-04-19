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
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Notes</th>
                                    <th class="px-4 py-3 text-left">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="hover:bg-gray-50 border-b">
                                        <td class="px-4 py-3">{{ $appointment->patient_name }}</td>
                                        <td class="px-4 py-3">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y - H:i') }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                                {{ $appointment->status == 'scheduled' ? 'bg-green-500 text-white' : 'bg-gray-400 text-white' }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">{{ $appointment->notes }}</td>
                                        <td class="px-4 py-3">
                                            <button 
                                                @click="showModal = true; appointmentId = {{ $appointment->id }}; message = `{{ $appointment->notes }}`"
                                                class="text-blue-500 hover:text-blue-700 font-semibold">
                                                Give Feedback
                                            </button>
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
