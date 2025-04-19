<x-Breastfeeding-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Child Records</h1>

        @if($children->isEmpty())
            <p class="text-center text-red-500">No children records found for the logged-in user.</p>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded p-6 mb-8">
                <table class="min-w-full table-auto border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-left">
                            <th class="px-6 py-4 border-b">SN</th>
                            <th class="px-6 py-4 border-b">Child Name</th>
                            <th class="px-6 py-4 border-b">Record Date</th>
                            <th class="px-6 py-4 border-b">Weight</th>
                            <th class="px-6 py-4 border-b">Height</th>
                            <th class="px-6 py-4 border-b">Head Circumference</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-gray-700">
                        @php $index = 1; @endphp
                        @foreach($children as $child)
                            @foreach($child->records as $record)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 border-b">{{ $index++ }}</td>
                                    <td class="px-6 py-4 border-b">{{ $child->name }}</td>
                                    <td class="px-6 py-4 border-b">{{ \Carbon\Carbon::parse($record->record_date)->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 border-b">{{ $record->weight }} kg</td>
                                    <td class="px-6 py-4 border-b">{{ $record->height }} cm</td>
                                    <td class="px-6 py-4 border-b">{{ $record->head_circumference }} cm</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- 📈 Baby Growth Chart Section -->
            <div class="bg-white shadow-md rounded p-6 mb-12">
                <h2 class="text-2xl font-bold text-center mb-4 text-gray-800">Baby Growth Chart</h2>
                <div class="w-full overflow-x-auto">
                    <canvas id="growthChart" style="min-width: 1000px; height: 500px;"></canvas>
                </div>
            </div>
        @endif
    </div>

    <!-- 📊 Chart.js Script -->
    <script>
        var graphData = @json($graphData);

        var labels = [];
        var weightData = [];
        var heightData = [];
        var headCircumferenceData = [];

        graphData.forEach(function(child) {
            child.records.forEach(function(record) {
                labels.push(record.record_date);
                weightData.push(record.weight);
                heightData.push(record.height);
                headCircumferenceData.push(record.head_circumference);
            });
        });

        const ctx = document.getElementById('growthChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Weight (kg)',
                        data: weightData,
                        borderColor: '#ef4444',
                        backgroundColor: '#fee2e2',
                        tension: 0.3,
                        fill: false
                    },
                    {
                        label: 'Height (cm)',
                        data: heightData,
                        borderColor: '#3b82f6',
                        backgroundColor: '#dbeafe',
                        tension: 0.3,
                        fill: false
                    },
                    {
                        label: 'Head Circumference (cm)',
                        data: headCircumferenceData,
                        borderColor: '#10b981',
                        backgroundColor: '#d1fae5',
                        tension: 0.3,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Measurements'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    </script>
</x-Breastfeeding-layout>
