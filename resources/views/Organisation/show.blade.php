<x-Organisation-layout>
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Report Details</h1>

        <div class="space-y-4">
            <div>
                <span class="font-semibold text-gray-700">Report ID:</span>
                <span>{{ $report->id }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Report Type:</span>
                <span>{{ $report->report_type }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Description:</span>
                <p class="text-gray-800">{{ $report->description }}</p>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Submitted By:</span>
                <span>{{ $report->user->email ?? 'N/A' }}</span>
            </div>
            <div>
                <span class="font-semibold text-gray-700">Uploaded File:</span><br>
                @if ($report->file_path)
                    <a href="{{ asset('storage/' . $report->file_path) }}" 
                       target="_blank" 
                       class="inline-block mt-2 text-blue-600 underline hover:text-blue-800">
                        Open File
                    </a>
                @else
                    <span>No file uploaded.</span>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-between flex-wrap gap-4">
            <a href="{{ route('organisation.index') }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                ← Back to Reports
            </a>

            <a href="{{ route('reports.print', $report->id) }}" 
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                 ⬇️ Download Report
             </a>
             

            <form action="{{ route('organisation.reports.destroy', $report->id) }}" 
                  method="POST" 
                  onsubmit="return confirm('Are you sure you want to delete this report?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    🗑️ Delete Report
                </button>
            </form>
        </div>
    </div>
</x-Organisation-layout>
