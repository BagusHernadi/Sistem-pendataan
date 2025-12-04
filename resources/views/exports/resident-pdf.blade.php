<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penduduk</title>

    <style>
        body { font-family: sans-serif; padding: 20px; font-size: 13px; }
        .title { text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background: #eeeeee; }
    </style>
</head>
<body>

    <div class="title">LAPORAN PENDUDUK</div>

     <h4>Anggota</h4>
    <table>
        <tr>
            <th>Nama</th>
            <th>Jumlah</th>
        </tr>
        
        <tr>
        </tr>
    </table>

    <h4>Jenis Kelamin</h4>
    <table>
        <tr>
            <th>Jenis Kelamin</th>
            <th>Jumlah</th>
        </tr>
        @foreach($genderCount as $gender => $jumlah)
        <tr>
            <td>{{ $gender }}</td>
            <td>{{ $jumlah }}</td>
        </tr>
        @endforeach
    </table>

    <h4>Status Perkawinan</h4>
    <table>
        <tr>
            <th>Status</th>
            <th>Jumlah</th>
        </tr>
        @foreach($statusCount as $status => $jumlah)
        <tr>
            <td>{{ $status }}</td>
            <td>{{ $jumlah }}</td>
        </tr>
        @endforeach
    </table>

</body>
</html>
