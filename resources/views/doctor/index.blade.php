<x-doctor-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">Doctor Dashboard</h1>
 
       <!-- 👩‍⚕️ User Stats Section -->
       <div class="flex flex-col md:flex-row justify-center items-center gap-6 mb-12">
           <!-- Pregnant Women -->
           <div class="bg-white shadow-md rounded-lg p-4 w-64 flex items-center space-x-4">
               <i class='bx bx-female text-4xl text-blue-500'></i>
               <div>
                   <p class="text-gray-500 text-sm">Pregnant Women</p>
                   <p class="text-2xl font-semibold text-gray-800">{{ $pregnantWomenCount }}</p>
               </div>
           </div>
 
           <!-- Breastfeeding Women -->
           <div class="bg-white shadow-md rounded-lg p-4 w-64 flex items-center space-x-4">
               <i class='bx bx-female text-4xl text-green-500'></i>
               <div>
                   <p class="text-gray-500 text-sm">Breastfeeding Women</p>
                   <p class="text-2xl font-semibold text-gray-800">{{ $breastfeedingWomenCount }}</p>
               </div>
           </div>
 
           <!-- Children -->
           <div class="bg-white shadow-md rounded-lg p-4 w-64 flex items-center space-x-4">
               <i class='bx bx-child text-4xl text-orange-500'></i>
               <div>
                   <p class="text-gray-500 text-sm">Children</p>
                   <p class="text-2xl font-semibold text-gray-800">{{ $childrenCount }}</p>
               </div>
           </div>
       </div>
 
        <!-- 📊 Combined Diseases Chart Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Combined Disease Statistics</h2>
            <div class="flex justify-center items-center">
                <div class="w-full md:w-[650px] lg:w-[700px]">
                    <h3 class="text-lg font-semibold text-center mb-2">Children vs Pregnant Diseases</h3>
                    <canvas id="combinedDiseasesChart" style="height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Chart.js Script -->
    <script>
        const childrenDiseasesLabels = @json($childrenDiseases->pluck('name'));
        const childrenDiseasesData = @json($childrenDiseases->pluck('count'));
 
        const pregnantDiseasesLabels = @json($pregnantDiseases->pluck('name'));
        const pregnantDiseasesData = @json($pregnantDiseases->pluck('count'));
 
        // Combined Diseases Chart
        new Chart(document.getElementById('combinedDiseasesChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: childrenDiseasesLabels, // Use the labels for Children Diseases (assuming both charts share same disease names)
                datasets: [{
                    label: 'Children Diseases',
                    data: childrenDiseasesData,
                    borderColor: '#3b82f6',
                    backgroundColor: '#dbeafe',
                    tension: 0.4,
                    fill: false
                }, {
                    label: 'Pregnant Diseases',
                    data: pregnantDiseasesData,
                    borderColor: '#ef4444',
                    backgroundColor: '#fee2e2',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { title: { display: true, text: 'Disease Name' }},
                    y: { beginAtZero: true, title: { display: true, text: 'Count' }}
                },
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { mode: 'index', intersect: false }
                },
                interaction: { mode: 'nearest', axis: 'x', intersect: false }
            }
        });
    </script>
 </x-doctor-layout>
 