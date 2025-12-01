<!DOCTYPE html>
<html>
<head>
    <title>Residents PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Residents List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($residents as $resident)
                <tr>
                    <td>{{ $resident->id }}</td>
                    <td>{{ $resident->name }}</td>
                    <td>{{ $resident->address }}</td>
                    <td>{{ $resident->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
