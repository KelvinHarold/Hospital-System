<x-doctor-layout>
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold mb-6 text-blue-800">Doctor Replies</h2>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden border">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Doctor</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Reply</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-6 py-3 text-center text-sm font-medium text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($feedbacks as $index => $feedback)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ $feedback->doctor->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $feedback->reply }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $feedback->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No replies from the doctor yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-doctor-layout>
