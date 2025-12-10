@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Data Penduduk</h1>
        <div class="d-none d-sm-inline-block">
            <button class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </button>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
                </div>
                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="start_date" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="end_date" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <div class="col-md-4 mb-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-1"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penduduk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data akan diisi melalui JavaScript -->
                        <tr>
                            <td colspan="5" class="text-center">Gunakan filter di atas untuk menampilkan data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("reports.data") }}',
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [
                { data: 'nik', name: 'nik' },
                { data: 'name', name: 'name' },
                { data: 'gender', name: 'gender' },
                { data: 'address', name: 'address' },
                { data: 'status', name: 'status' },
            ],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            }
        });

        // Reload table when filter is submitted
        $('form').on('submit', function(e) {
            e.preventDefault();
            $('#dataTable').DataTable().ajax.reload();
        });
    });
</script>
@endpush

@endsection
