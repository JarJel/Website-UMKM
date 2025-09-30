@extends('superadmin.adminSuper')

@section('title', 'Dashboard')

@section('content')
    <h2 class="page-title text-2xl sm:text-3xl font-bold mb-6 sm:mb-8">Dashboard Super Admin</h2>

    <!-- Success and Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Statistik Ringkas (Dummy) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="stat-card p-4 sm:p-6 flex items-center justify-between">
            <div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-600">Total BUMDES</h3>
                <p class="text-2xl sm:text-3xl font-bold mt-2" style="color: var(--primary);">{{ $totalBumdes ?? '' }}
</p>
            </div>
            <div class="stat-icon">
                <i class="fas fa-building text-xl"></i>
            </div>
        </div>

        <div class="stat-card p-4 sm:p-6 flex items-center justify-between">
            <div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-600">Total Toko</h3>
                <p class="text-2xl sm:text-3xl font-bold mt-2" style="color: var(--secondary);">{{ $totalToko ?? '' }}</p>
            </div>
            <div class="stat-icon">
                <i class="fas fa-exchange-alt text-xl"></i>
            </div>
        </div>

        <div class="stat-card p-4 sm:p-6 flex items-center justify-between">
            <div>
                <h3 class="text-base sm:text-lg font-semibold text-gray-600">Total User</h3>
                <p class="text-2xl sm:text-3xl font-bold mt-2" style="color: var(--accent);">{{ $totalUser ?? '' }}</p>
            </div>
            <div class="stat-icon">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>

    </div>

    <!-- Grafik Statistik Dummy -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="chart-container p-4 sm:p-6 bg-white shadow rounded">
            <h3 class="text-lg sm:text-xl font-semibold mb-4" style="color: var(--primary);">Statistik User</h3>
            <canvas id="userChart"></canvas>
        </div>
        <div class="chart-container p-4 sm:p-6 bg-white shadow rounded">
            <h3 class="text-lg sm:text-xl font-semibold mb-4" style="color: var(--primary);">Statistik Toko</h3>
            <canvas id="tokoChart"></canvas>
        </div>
        <div class="chart-container p-4 sm:p-6 bg-white shadow rounded">
            <h3 class="text-lg sm:text-xl font-semibold mb-4" style="color: var(--primary);">Statistik Bumdes</h3>
            <canvas id="bumdesChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"];

    // User Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    new Chart(userCtx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'User Baru',
                data: @json(array_map(fn($m) => $userPerMonth[$m] ?? 0, range(1,12))),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Toko Chart
    const tokoCtx = document.getElementById('tokoChart').getContext('2d');
    new Chart(tokoCtx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Toko Baru',
                data: @json(array_map(fn($m) => $tokoPerMonth[$m] ?? 0, range(1,12))),
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    // Bumdes Chart
    const bumdesCtx = document.getElementById('bumdesChart').getContext('2d');
    new Chart(bumdesCtx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Bumdes Baru',
                data: @json(array_map(fn($m) => $bumdesPerMonth[$m] ?? 0, range(1,12))),
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
</script>
@endsection
