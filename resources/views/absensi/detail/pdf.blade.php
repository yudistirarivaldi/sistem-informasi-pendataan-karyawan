<!DOCTYPE html>
<html>

<head>
    <title>Apurav - Report</title>
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

        table.table {
            border-bottom: 4px solid #000;
            padding: 2px
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }
    </style>

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
        <b>DAFTAR ABSENSI</b>
    </div>


    <table style="">
        <tr>
            <td colspan="2" style="width: 100px;">Periode</td>
            <td colspan="5">: {{ str_replace('-', ' - ', ucwords($absensi->periode)) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="width: 100px;">Departement</td>
            <td colspan="5" style="text-align: left">: {{ ucwords($filter) }}</td>
        </tr>
    </table>
    <br>

    <table border="1" style="font-size: 14px;width: 100%;">
        <tbody>
            <tr style="font-weight: bold;line-height: 2;text-align: center;background-color: #18c33e;">
                <td colspan="3" style="vertical-align : middle;width: 10px;">KEAHLIAN</td>
                @if (count($attendance_date) > 0)
                    <td colspan="{{ count($attendance_date) }}"
                        style="vertical-align : middle;white-space:normal;
                    width: auto;
                    height: auto;
                    word-wrap: break-word;">
                        TANGGAL ABSEN</td>
                @endif
                <td rowspan="2" style="vertical-align : middle;">Total Kehadiran</td>
            </tr>

            <tr style="line-height: 2;text-align: center;background-color: #dee2e6;">
                <td style="width:5px;height: 20px;">No.</td>
                <td>Nama</td>
                <td>Posisi</td>
                {{-- <td>Departement</td> --}}

                @foreach ($attendance_date as $d)
                    <td style="min-width:50px; vertical-align: middle; text-align: center; background-color: yellow">
                        {{ date('d', strtotime($d->tanggal_absen)) }}</td>
                @endforeach

            </tr>
            @php
                $grand_total = 0;
            @endphp

            @forelse ($schedules as $schedule)
                <tr style="text-align: left;" id="master">
                    <td style="text-align: center">{{ $loop->iteration }}</td>
                    <td>{{ $schedule->staff->name }}</td>
                    <td>{{ $schedule->staff->position->name }}</td>
                    {{-- <td>{{ $schedule->staff->departement->name }}</td> --}}
                    @php
                        $sum_kehadiran = 0;
                        $sum_jam = 0;
                        $grand_hari = 0;
                        $grand_lembur = 0;
                        $count_absen_staff = $schedule->absensi->where('periode', $absensi->periode)->count();
                    @endphp
                    @forelse ($schedule->absensi->where('periode', $absensi->periode) as $item)
                        @if ($loop->first)
                            @if (count($attendance_date) != $count_absen_staff)
                                <td style="vertical-align: middle; background-color: #ccc"
                                    colspan="{{ intval(count($attendance_date)) - intval($count_absen_staff) }}"></td>
                            @endif
                        @endif

                        @if ($item->attendance_id != '')
                            <td
                                style="color: black; text-align: center; background-color:  {{ $item->attendance->color }}">
                                {{ $item->attendance->singkatan }}
                            </td>
                        @else
                            <td style="width:20px;text-align: center;"><i style="line-height: 0.2;"></i></td>
                        @endif

                        @php
                            $sum_jam += $item->jumlah_lembur;
                            $sum_kehadiran += $item->attendance->value;
                            $grand_hari = $sum_kehadiran * $schedule->schedule;
                            $grand_lembur = $sum_jam * $schedule->uang_overtime;
                        @endphp
                    @empty
                    @endforelse

                    @php
                        $total = $grand_hari + $grand_lembur;
                        $grand_total += $total;
                    @endphp
                    <td style="vertical-align: middle; text-align: center;">{{ $sum_kehadiran }}</td>
                </tr>
            @empty
                <td style="text-align: center;" colspan="{{ 3 + count($attendance_date) + 7 }}">Tidak ada data</td>
            @endforelse
        </tbody>
    </table>
</body>

</html>
