@php
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Content-type: application/x-msexcel');
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename=Laporan-staff-' . 'staff' . '.xls');
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>SIPG - Report</title>
    <style>
        #master td {
            vertical-align: middle;

        }
    </style>
</head>

<body>
    <div style="text-align: center; font-size: 20px;">
        <b>DATA LEMBUR KARYAWAN</b>
    </div>

    <br>
    <table border="1" style="font-size: 14px;width: 50%;">
        <thead>
            <tr style="background-color: royalblue">
                <th>Staff</th>
                <th>Departement</th>
                <th>Jumlah Lembur</th>
                <th>Tgl Lembur</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($items as $item)
                <tr style="line-height: 1;">
                    <td>{{ $item->staff->name }}</td>
                    <td>{{ $item->departement->name }}</td>
                    <td>{{ $item->jumlah_overtime }}</td>
                    <td>{{ $item->tgl_overtime }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7">Tidak ada data untuk ditampilkan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <br>

</body>

</html>
