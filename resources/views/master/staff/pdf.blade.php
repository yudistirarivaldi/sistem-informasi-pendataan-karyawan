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
    </style>

    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="img/hicol.png" alt="" width="140px"></td>
                <td class="tengah">
                    <h2>PT. GENERASI ANAK MUDA BERKARYA</h2>
                    <p style="font-size: 15px">Jl. Letjen S. Parman No.24, RT.1/RW.4, Palmerah Kota Jakarta Barat</p>
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

</body>

</html>
