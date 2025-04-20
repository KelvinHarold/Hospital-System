<x-report-layout>
    <div class="p-8">
        <!-- Header with icon -->
        <div class="flex items-center mb-6">
            <i class="fas fa-file-alt text-2xl text-orange-500 mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">All Reports</h2>
        </div>

        @if(session('success'))
        <div class="p-4 mb-6 bg-green-100 text-green-800 rounded-lg border border-green-200 flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-hashtag mr-2 text-orange-500"></i>
                                <span>ID</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-tag mr-2 text-orange-500"></i>
                                <span>Category</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-align-left mr-2 text-orange-500"></i>
                                <span>Description</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-paperclip mr-2 text-orange-500"></i>
                                <span>File</span>
                            </div>
                        </th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-cog mr-2 text-orange-500"></i>
                                <span>Actions</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($reports as $report)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $report->id }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full flex items-center w-fit">
                                <i class="fas fa-folder-open mr-2"></i>
                                {{ $report->report_type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $report->description }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if($report->file_path)
                            <a href="{{ asset('storage/' . $report->file_path) }}" 
                               class="text-blue-600 hover:text-blue-800 hover:underline flex items-center w-fit" 
                               target="_blank">
                                <i class="fas fa-file-download mr-2"></i>
                                View File
                            </a>
                            @else
                            <span class="text-gray-400 flex items-center">
                                <i class="fas fa-times-circle mr-2"></i>
                                No File
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex space-x-3">
                                <a href="{{ route('reports.show', $report->id) }}" 
                                   class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center">
                                    <i class="fas fa-eye mr-2"></i>
                                    View
                                </a>
                                <a href="{{ route('reports.print', $report->id) }}"
                                   target="_blank"
                                   class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 flex items-center">
                                    <i class="fas fa-print mr-2"></i>
                                    Print
                                </a>
                                <form method="POST" action="{{ route('reports.destroy', $report->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this report?')"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 flex items-center">
                                        <i class="fas fa-trash-alt mr-2"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-folder-open text-4xl mb-3"></i>
                            <p>No reports available.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Font Awesome in the layout if not already present -->
    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush
</x-report-layout>
