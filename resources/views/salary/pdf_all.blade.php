<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Gaji Karyawan</title>
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
                <td><img src="{{-- <td><img src="{{ asset('img/logo-perumda.png') }}" alt="" width="140px"></td> --}}" alt="" width="140px"></td>
                <td class="tengah">
                    <h4>PERUMDA PASAR MARTAPURA</h4>
                    <p>Cindai Alus, Martapura, Banjar Regency, South Kalimantan 71213</p>
                </td>
            </tr>
        </table>
    </div>
    <center>
        <br>
        <h5>Laporan Data Gaji Karyawan

        </h5>
    </center>


    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Staff</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>Periode</th>
                <th>Total Gaji</th>
                <th>Tanggal</th>

            </tr>
        </thead>
        <tbody>
            @forelse ($salary as $item)
                <tr style="line-height: 1;">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->staff->name }}</td>
                    <td>{{ $item->staff->nik }}</td>
                    <td>{{ $item->staff->jenis_kelamin }}</td>
                    <td>{{ ucwords($item->periode) }}</td>
                    <td>Rp. {{ number_format($item->salary, 0, ',', '.') }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl_salary)) }}</td>
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
