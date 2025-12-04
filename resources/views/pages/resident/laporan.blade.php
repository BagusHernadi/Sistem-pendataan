@extends('layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Laporan Anggota</h1>

<!-- Export Buttons -->
<a class="btn btn-success btn-sm" href="{{ route('resident.excel') }}">Export Excel</a>
<a class="btn btn-danger btn-sm" href="{{ route('resident.pdf') }}" target="_blank">Export PDF</a>

<div class="row mt-4">

    <!-- Grafik Jenis Kelamin -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                Grafik Statistik Jenis Kelamin
            </div>
            <div class="card-body">
                <canvas id="genderChart" height="160"></canvas>
            </div>
        </div>
    </div>

    <!-- Grafik Status Keanggotaan -->
    <div class="col-lg-6">
        <div class="card shadow mb-4">
            <div class="card-header bg-success text-white">
                Grafik Status Keanggotaan
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="160"></canvas>
            </div>
        </div>
    </div>

</div>

<!-- Tabel Data -->
<div class="card shadow">
    <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($residents as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->nik }}</td>
                    <td>{{ $r->name }}</td>
                    <td>
                        @if($r->status == 'active')
                            <span class="badge badge-success">Aktif</span>
                        @elseif($r->status == 'moved')
                            <span class="badge badge-warning">Pindah</span>
                        @else
                            <span class="badge badge-danger">Meninggal</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

{{-- SCRIPT CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // === Grafik Jenis Kelamin ===
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($genderCount)) !!},
            datasets: [{
                data: {!! json_encode(array_values($genderCount)) !!},
                backgroundColor: ['#4e73df','#e74a3b']
            }]
        }
    });

    // === Grafik Status Anggota ===
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_keys($statusCount)) !!},
            datasets: [{
                label: 'Jumlah',
                data: {!! json_encode(array_values($statusCount)) !!},
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b']
            }]
        },
        options: { responsive: true }
    });
</script>

@endsection
