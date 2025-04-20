<x-report-layout>
    <div class="max-w-4xl mx-auto p-8 bg-white rounded shadow-lg mt-10">
        <div class="flex items-center mb-6">
            <i class="fas fa-eye text-2xl text-blue-600 mr-3"></i>
            <h2 class="text-2xl font-bold text-gray-800">Report Details</h2>
        </div>

        <div class="mb-4">
            <h4 class="text-gray-600 font-semibold">Report ID:</h4>
            <p class="text-gray-800">{{ $report->id }}</p>
        </div>

        <div class="mb-4">
            <h4 class="text-gray-600 font-semibold">Category:</h4>
            <p class="text-orange-700 px-3 py-1 bg-orange-100 inline-block rounded">
                <i class="fas fa-folder-open mr-1"></i> {{ $report->report_type }}
            </p>
        </div>

        <div class="mb-4">
            <h4 class="text-gray-600 font-semibold">Description:</h4>
            <p class="text-gray-800">{{ $report->description }}</p>
        </div>

        <div class="mb-6">
            <h4 class="text-gray-600 font-semibold">Attached File:</h4>
            @if($report->file_path)
                <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank"
                   class="text-blue-600 hover:underline flex items-center mt-1">
                    <i class="fas fa-file-download mr-2"></i> View File
                </a>
            @else
                <p class="text-gray-400 flex items-center"><i class="fas fa-times-circle mr-2"></i>No File Attached</p>
            @endif
        </div>

        <a href="{{ route('reports.index') }}" class="inline-block mt-6 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i> Back to Reports
        </a>
    </div>
</x-report-layout>
