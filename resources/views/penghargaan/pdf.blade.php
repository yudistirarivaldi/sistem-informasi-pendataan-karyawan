<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Mutasi Masuk Karyawan</title>
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

        .ttd {
            margin-top: 50px;
            text-align: right;
        }

        .ttd img {
            width: 150px;
            height: auto;
        }
    </style>

    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td>
                    <img src="{{ public_path('img/logo-perumda.png') }}" alt="Logo Perumda" width="140px">
                </td>
                <td class="tengah">
                    <h4>PERUMDA PASAR MARTAPURA</h4>
                    <p>Cindai Alus, Martapura, Banjar Regency, South Kalimantan 71213</p>
                </td>
            </tr>
        </table>
    </div>
    <center>
        <br>
        <h5>Laporan Data Mutasi Karyawan

        </h5>
    </center>


    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Staff</th>
                <th>NIK</th>
                <th>Posisi</th>
                <th>Jenis Kelamin</th>
                <th>Dari Kantor</th>
                <th>Kantor Tujuan</th>
                <th>Keterangan</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($mutasi as $item)
                <tr style="line-height: 1;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->staff->name }}</td>
                    <td>{{ $item->staff->nik }}</td>
                    <td>{{ $item->position->name }}</td>
                    <td>{{ $item->staff->jenis_kelamin }}</td>
                    <td>{{ $item->dari }}</td>
                    <td>{{ $item->ke }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="5">Tidak ada data untuk ditampilkan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd">
        <p>Banjarbaru, {{ date('d F Y') }}</p>
        <p>Direktur/Pimpinan</p>
        <img src="https://upload.wikimedia.org/wikipedia/id/b/b7/Tanda_Tangan_Sjachroedin_ZP.png" alt="Tanda Tangan">
        <p><b>Muhammad Yamin</b></p>
    </div>

</body>

</html>
