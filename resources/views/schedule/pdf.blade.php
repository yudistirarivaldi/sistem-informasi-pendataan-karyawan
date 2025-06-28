<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Jadwal Masuk Karyawan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        body {
            font-family: arial;

        }

        table {
            border-bottom: 4px solid #000;
            padding: 2px
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }
    </style>

    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="{{-- <td><img src="https://i.pinimg.com/736x/c6/82/73/c68273edeb333a7f3765c02ed509b55d.jpg" alt="" width="140px"></td> --}}" alt="" width="140px"></td>
                <td class="tengah">
                    <h4>PERUMDA PASAR MARTAPURA</h4>
                    <p>Cindai Alus, Martapura, Banjar Regency, South Kalimantan 71213</p>
                </td>
            </tr>
        </table>
    </div>
    <center>
        <br>
        <h5>Laporan Data Jadwal Masuk Karyawan

        </h5>
    </center>


    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Staff</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Masuk</th>
                <th>Keterangan Jadwal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($schedule as $item)
                <tr style="line-height: 1;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->staff->name }}</td>
                    <td>{{ $item->staff->nik }}</td>
                    <td>{{ $item->staff->jenis_kelamin }}</td>
                    <td>{{ $item->tgl_masuk }}</td>
                    <td>{{ $item->ket_schedule }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="5">Tidak ada data untuk ditampilkan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
