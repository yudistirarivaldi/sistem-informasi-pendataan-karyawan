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
        <b>DATA CUTI KARYAWAN</b>
    </div>

    <br>
    <table border="1" style="font-size: 14px;width: 50%;">
        <thead>
            <tr style="background-color: royalblue">
                <th>Staff</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Durasi</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($items as $item)
                <tr style="line-height: 1;">
                    <td>{{ $item->staff->name }}</td>
                    <td>{{ $item->tgl_mulai }}</td>
                    <td>{{ $item->tgl_selesai }}</td>
                    <td>{{ $item->jumlah_cuti }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ $item->status }}</td>
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
