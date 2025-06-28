@php
    header('Cache-Control: no-cache, must-revalidate');
    header('Pragma: no-cache');
    header('Content-type: application/octet-stream');
    
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Report Gaji</title>
    <style>
        #master td {
            vertical-align: middle;

        }

        body {
            font-family: arial;

        }

        table.table {
            border-bottom: 4px solid #000;
            padding: 2px
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <table class="table" width="100%">
            <tr>
                <td><img src="{{-- <td><img src="https://i.pinimg.com/736x/c6/82/73/c68273edeb333a7f3765c02ed509b55d.jpg" alt="" width="140px"></td> --}}" alt="" width="140px"></td>
                <td class="tengah">
                    <h2>PERUMDA PASAR MARTAPURA</h2>
                    <p>Cindai Alus, Martapura, Banjar Regency, South Kalimantan 71213</p>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div style="text-align: center; font-size: 20px;">
        <b>SLIP GAJI KARYAWAN</b>
    </div>

    <br>
    <table style="">
        <tr>
            <td width="100">Nama</td>
            <td colspan="3">: {{ $staff->name }}</td>
        </tr>
        <tr>
            <td width="100">NIK</td>
            <td colspan="3">: {{ $staff->nik }}</td>
        </tr>
        <tr>
            <td width="100">Position Status</td>
            <td colspan="3">: {{ $staff->position->status }}</td>
        </tr>
        <tr>
            <td>Periode</td>
            <td colspan="3">: {{ ucwords($filter ?? 'All') }}</td>
        </tr>
    </table>
    <br>

    <table border="1" style="font-size: 14px;width: 100%;">
        <thead>
            <tr style="background-color: royalblue">
                <th>Periode</th>
                <th>Gaji</th>
                <th>Tgl. Gaji</th>
                <th>Status</th>
                <th>Lembur</th>
                <th>Gaji Lembur</th>
                @if ($staff->position->status == 'Staff')
                    <th>BPJS</th>
                    <th>Transportasi</th>
                @endif
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($salary as $item)
                <tr style="line-height: 1;">
                    <td>{{ ucwords($item->periode) }}</td>
                    <td>Rp. {{ number_format($item->salary, 0, ',', '.') }}</td>
                    <td>{{ date('d-m-Y', strtotime($item->tgl_salary)) }}</td>
                    <td style="background-color:  {{ $item->status_gaji == 'Dibayar' ? 'green' : 'yellow' }}">
                        {{ $item->status_gaji ?? 'Belum Dibayar' }}</td>
                    <td>{{ $item->jumlah_overtime }}</td>
                    <td>Rp. {{ number_format($item->uang_overtime, 0, ',', '.') }} / Jam</td>
                    @if ($staff->position->status == 'Staff')
                        <td>Rp. {{ number_format($item->pot_bpjs, 0, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->transportasi, 0, ',', '.') }}</td>
                    @endif
                    <td style="font-weight: bold;">Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7">Tidak ada data untuk ditampilkan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <br>

    <div class="ttd mr-7" style="position: relative; left: 80%">
        <p>Banjarbaru, {{ date('d-M-Y') }} </p>
        <p>HRD</p>
        <br>
        <br>
        <br>
        <br>
        <b>Lulu Agustin, SE.</b>
    </div>


</body>

</html>
