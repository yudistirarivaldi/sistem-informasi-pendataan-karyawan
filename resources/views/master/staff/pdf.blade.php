<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Karyawan</title>
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
                    <h2>PERUMDA PASAR MARTAPURA</h2>
                    <p style="font-size: 15px">Cindai Alus, Martapura, Banjar Regency, South Kalimantan 71213</p>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <center>
        <h5>Laporan Data Karyawan

        </h5>
    </center>



    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Position</th>
                <th>Departement</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($staff as $item)
                <tr style="line-height: 1;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->birth }}</td>
                    <td>{{ $item->addres }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->position->name }}</td>
                    <td>{{ $item->departement->name ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7">Tidak ada data untuk ditampilkan</td>
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
