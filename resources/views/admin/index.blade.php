<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-dashboard-card title="Admins" :count="$adminCount" icon="user-shield" />
                <x-dashboard-card title="Doctors" :count="$doctorCount" icon="user-md" />
                <x-dashboard-card title="Pregnant Women" :count="$pregnantCount" icon="female" />
                <x-dashboard-card title="Breastfeeding Women" :count="$breastfeedingCount" icon="baby" />
                <x-dashboard-card title="Children" :count="$childCount" icon="child" />
                <x-dashboard-card title="Organisations" :count="$organisationCount" icon="building" />
            </div>

            {{-- Chart --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Users by Role</h2>
                <canvas id="userChart" height="100"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            fetch("{{ route('admin.user-role-counts') }}")
                .then(response => response.json())
                .then(({ labels, data }) => {
                    const ctx = document.getElementById('userChart').getContext('2d');
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
                    gradient.addColorStop(1, 'rgba(75, 192, 192, 0)');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'User Count',
                                data: data,
                                fill: true,
                                backgroundColor: gradient,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                tension: 0.4,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: 'rgba(75, 192, 192, 1)',
                                pointHoverRadius: 5,
                                pointRadius: 4
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
</x-admin-layout>
