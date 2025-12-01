<!DOCTYPE html>
<html>
<head>
    <title>Residents Excel</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Daftar Anggota</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($residents as $resident)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $resident->name }}</td>
                    <td>{{ $resident->nik }}</td>
                    <td>{{ $resident->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
