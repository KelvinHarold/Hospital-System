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
    
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Number of Users',
                                data: data,
                                backgroundColor: [
                                    '#1f77b4', // Admins - blue
                                    '#2ca02c', // Doctors - green
                                    '#ff7f0e', // Pregnant Women - orange
                                    '#d62728', // Breastfeeding Women - red
                                    '#9467bd', // Children - purple
                                    '#8c564b'  // Organisations - brown
                                ],
                                borderColor: '#fff',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: true,
                                    text: 'Distribution of Users by Role',
                                    font: {
                                        size: 18
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 50,
                                    ticks: {
                                        stepSize: 5
                                    },
                                    title: {
                                        display: true,
                                        text: 'Number of Users',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        }
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'User Roles',
                                        font: {
                                            size: 14,
                                            weight: 'bold'
                                        }
                                    }
                                }
                            }
                        }
                    });
                });
        });
    </script>
    
</x-admin-layout>
