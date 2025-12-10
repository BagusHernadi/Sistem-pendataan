@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="dashboard-title">Dashboard</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="d-flex">
                    <div class="me-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fas fa-calendar-alt"></i></span>
                            <input type="text" class="form-control border-start-0" id="datePicker" readonly>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-primary h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Penduduk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalResidents) }}</div>
                            <div class="mt-2">
                                @if($percentageChange >= 0)
                                    <span class="text-success"><i class="fas fa-arrow-up"></i> {{ abs($percentageChange) }}%</span>
                                @else
                                    <span class="text-danger"><i class="fas fa-arrow-down"></i> {{ abs($percentageChange) }}%</span>
                                @endif
                                <span class="text-muted">dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-success h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Laki-laki</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($maleCount) }}</div>
                            <div class="mt-2">
                                @php
                                    $malePercentage = $totalResidents > 0 ? round(($maleCount / $totalResidents) * 100) : 0;
                                @endphp
                                <span class="text-muted">{{ $malePercentage }}% dari total</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-male fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-info h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Perempuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($femaleCount) }}</div>
                            <div class="mt-2">
                                @php
                                    $femalePercentage = $totalResidents > 0 ? round(($femaleCount / $totalResidents) * 100) : 0;
                                @endphp
                                <span class="text-muted">{{ $femalePercentage }}% dari total</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-female fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-warning h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Penduduk Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($newResidentsThisMonth) }}</div>
                            <div class="mt-2">
                                <span class="text-muted">bulan ini</span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Chart Section -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Statistik Penduduk</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                            <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                            <li><a class="dropdown-item" href="#">Bulan Ini</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Tahun Ini</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="populationChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Menu Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('resident.create') }}" class="quick-action-card">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="quick-action-icon bg-primary-light">
                                            <i class="fas fa-user-plus text-primary"></i>
                                        </div>
                                        <h6 class="mt-3 mb-0">Tambah Penduduk</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('resident.index') }}" class="quick-action-card">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="quick-action-icon bg-success-light">
                                            <i class="fas fa-list text-success"></i>
                                        </div>
                                        <h6 class="mt-3 mb-0">Lihat Data ({{ $totalResidents }})</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('resident.excel') }}" class="quick-action-card">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="quick-action-icon bg-warning-light">
                                            <i class="fas fa-file-export text-warning"></i>
                                        </div>
                                        <h6 class="mt-3 mb-0">Ekspor Data</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('reports.index') }}" class="quick-action-card">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <div class="quick-action-icon bg-info-light">
                                            <i class="fas fa-chart-pie text-info"></i>
                                        </div>
                                        <h6 class="mt-3 mb-0">Laporan</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
                    <a href="#" class="btn btn-sm btn-link">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="activity-feed">
                        @forelse($recentActivities as $activity)
                        <div class="activity-item d-flex">
                            <div class="activity-badge 
                                @if($activity['type'] == 'created') bg-primary
                                @elseif($activity['type'] == 'updated') bg-success
                                @else bg-danger
                                @endif text-white rounded-circle">
                                <i class="fas 
                                    @if($activity['type'] == 'created') fa-user-plus
                                    @elseif($activity['type'] == 'updated') fa-edit
                                    @else fa-trash
                                    @endif"></i>
                            </div>
                            <div class="activity-content">
                                <div class="d-flex justify-content-between">
                                    <h6>
                                        @if($activity['type'] == 'created') Data Baru Ditambahkan
                                        @elseif($activity['type'] == 'updated') Data Diperbarui
                                        @else Data Dihapus
                                        @endif
                                    </h6>
                                    <small class="text-muted">{{ $activity['time'] }}</small>
                                </div>
                                <p class="mb-0">
                                    @if($activity['type'] == 'created')
                                        Data baru ditambahkan: <strong>{{ $activity['name'] }}</strong>
                                    @elseif($activity['type'] == 'updated')
                                        Data diperbarui: <strong>{{ $activity['name'] }}</strong>
                                    @else
                                        Data dihapus: <strong>{{ $activity['name'] }}</strong>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-3">
                            <p class="text-muted">Tidak ada aktivitas terbaru</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    :root {
        --primary: #4e73df;
        --primary-light: #e8eefc;
        --success: #1cc88a;
        --success-light: #d1f3e9;
        --info: #36b9cc;
        --info-light: #d1ecf1;
        --warning: #f6c23e;
        --warning-light: #fef5e6;
        --danger: #e74a3b;
        --danger-light: #fae2e0;
        --dark: #5a5c69;
        --light: #f8f9fc;
    }

    .dashboard-container {
        padding: 20px;
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .breadcrumb {
        background: none;
        padding: 0;
        margin: 0;
    }

    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
    }

    .stat-card {
        border-left: 0.25rem solid;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .stat-card .card-body {
        padding: 1.25rem;
    }

    .quick-action-card {
        text-decoration: none;
    }

    .quick-action-card .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .quick-action-card:hover .card {
        transform: translateY(-3px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .quick-action-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        font-size: 1.5rem;
    }

    .bg-primary-light {
        background-color: var(--primary-light);
    }

    .bg-success-light {
        background-color: var(--success-light);
    }

    .bg-warning-light {
        background-color: var(--warning-light);
    }

    .bg-info-light {
        background-color: var(--info-light);
    }

    .activity-feed {
        padding-left: 10px;
    }

    .activity-item {
        position: relative;
        padding-bottom: 20px;
        padding-left: 30px;
        border-left: 2px solid #e9ecef;
        margin-bottom: 20px;
    }

    .activity-item:last-child {
        border-left: 2px solid transparent;
    }

    .activity-badge {
        position: absolute;
        left: -15px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .activity-content {
        flex: 1;
    }

    .activity-content h6 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .activity-content p {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0;
    }

    .chart-area {
        position: relative;
        height: 300px;
        width: 100%;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 15px;
        }

        .quick-action-card .card {
            margin-bottom: 15px;
        }

        .activity-item {
            padding-left: 25px;
        }

        .activity-badge {
            left: -12px;
            width: 25px;
            height: 25px;
            font-size: 0.7rem;
        }
    }
</style>
@endpush

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    // Date Picker
    flatpickr("#datePicker", {
        locale: "id",
        dateFormat: "d M Y",
        defaultDate: "today",
        disableMobile: "true"
    });

    // Population Chart
    const ctx = document.getElementById('populationChart').getContext('2d');
    const populationChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyLabels) !!},
            datasets: [{
                label: 'Jumlah Penduduk',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                pointRadius: 3,
                pointHoverRadius: 5,
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            return 'Jumlah: ' + context.parsed.y + ' orang';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                },
                y: {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function(value, index, values) {
                            return value + ' orang';
                        }
                    },
                    grid: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }
            }
        }
    });

    // Update chart on window resize
    window.addEventListener('resize', function() {
        populationChart.resize();
    });
</script>
@endpush
@endsection