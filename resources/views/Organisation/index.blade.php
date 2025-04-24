<x-Organisation-layout>
  <div class="p-6 bg-white rounded-lg shadow">
      <h1 class="text-2xl font-bold mb-4">All Reports</h1>

      @if(session('success'))
          <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
              {{ session('success') }}
          </div>
      @endif

      <table class="w-full table-auto border-collapse">
          <thead class="bg-gray-100">
              <tr>
                  <th class="px-4 py-2">ID</th>
                  <th class="px-4 py-2">Type</th>
                  <th class="px-4 py-2">Description</th>
                  <th class="px-4 py-2">File</th>
                  <th class="px-4 py-2">Actions</th>
              </tr>
          </thead>
          <tbody>
              @foreach($reports as $report)
                  <tr class="border-t hover:bg-gray-50">
                      <td class="px-4 py-2">{{ $report->id }}</td>
                      <td class="px-4 py-2">{{ $report->report_type }}</td>
                      <td class="px-4 py-2">{{ $report->description }}</td>
                      <td class="px-4 py-2">
                          @if($report->file_path)
                              <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="text-blue-600 underline">View File</a>
                          @else
                              No File
                          @endif
                      </td>
                      <td class="px-4 py-2 flex space-x-2">
                          <a href="{{ route('organisation.reports.show', $report->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">View</a>
                          <form action="{{ route('organisation.reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this report?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                          </form>
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
  </div>
</x-Organisation-layout>
