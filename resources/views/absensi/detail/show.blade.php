@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.6-rc.1/dist/css/select2.min.css">
@endsection
@section('content')
    <div class="content-wrapper pb-3">
        <div class="content pb-5 pt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h3 class="card-title back-top" style="margin-top: 5px;">
                                    <a href="{{ route('absensi.index') }}" title="Kembali" data-toggle="tooltip"
                                        data-placement="right" class="btn text-muted">
                                        <i class="fa fa-arrow-left fa-fw"></i></span>
                                    </a>
                                </h3>
                                <div class="float-left offset-5 pt-1">
                                    <span class="d-none d-md-block d-lg-block">DAFTAR ABSENSI</span>
                                </div>
                                <div class="float-right row">
                                    <form action="{{ url()->current() }}">
                                        <div class="input-group">
                                            <select name="filter" class="form-control input-sm select2">
                                                <option value="">Tampilkan semua</option>
                                                @if (!empty($filter))
                                                    <option value="all">SHOW ALL</option>
                                                @endif
                                                @foreach ($departement as $item)
                                                    <option value="{{ $item->name }}"
                                                        {{ $item->name == old('filter', $filter) ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="container-fluid row p-2" style="font-size: 14px;">
                                <div class="col-md-9 p-0">
                                    <table class="table no-border header-table mb-0" style="white-space: normal;">
                                        <tr style="line-height: 1px;">
                                            <td style="width: 100px;">Periode</td>
                                            <td style="width: 5px;">:</td>
                                            <td>{{ str_replace('-', ' - ', ucwords($absensi->periode)) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="card-body p-0">
                                    <table class="table table-bordered mb-0" style="font-size: 14px;">
                                        <thead>
                                            <tr class="text-center bg-light" style="font-weight: bold; line-height: 1;">
                                                <td colspan="4" style="vertical-align: middle;">KEAHLIAN</td>
                                                @if (count($attendance_date) > 0)
                                                    <td colspan="{{ count($attendance_date) }}" style="vertical-align: middle;">
                                                        TANGGAL ABSEN
                                                    </td>
                                                @endif
                                                <td rowspan="2" style="vertical-align: middle;">TOTAL</td>
                                            </tr>
                                            <tr class="text-center bg-light">
                                                <td style="width:5px;">NO.</td>
                                                <td>Nama</td>
                                                <td>Status</td>
                                                <td>Departement</td>
                                                @foreach ($attendance_date as $d)
                                                    <td class="count_date_absen">
                                                        {{ date('d', strtotime($d->tanggal_absen)) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $grand_total = 0;
                                            @endphp
                            
                                            @forelse ($schedules as $schedule)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $schedule->staff->name }}</td>
                                                    <td class="text-center">
                                                        <span class="badge {{ $schedule->staff->position->status == 'Staff' ? 'badge-info' : 'badge-secondary' }}">
                                                            {{ $schedule->staff->position->status ?? '-' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">{{ $schedule->staff->departement->name ?? '-' }}</td>
                            
                                                    @php
                                                        $sum_kehadiran = 0;
                                                        $absensi_per_tanggal = $schedule->absensi->where('periode', $absensi->periode);
                                                    @endphp
                            
                                                    @foreach ($attendance_date as $d)
                                                        @php
                                                            // Cek apakah ada absensi di tanggal tertentu
                                                            $absen = $absensi_per_tanggal->firstWhere('tanggal_absen', $d->tanggal_absen);
                                                        @endphp
                            
                                                        @if ($absen)
                                                            <td class="text-center">
                                                                {!! '<span class="' . $absen->attendance->label . '">' . $absen->attendance->singkatan . '</span>' !!}
                                                                @php
                                                                    $sum_kehadiran += $absen->attendance->value;
                                                                @endphp
                                                            </td>
                                                        @else
                                                            <td class="text-center">
                                                                <i class="fa fa-minus text-danger"></i>
                                                            </td>
                                                        @endif
                                                    @endforeach
                            
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        {{ $sum_kehadiran }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="{{ 5 + count($attendance_date) }}">
                                                        Tidak ada data
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer p-2">
                                @if (!Auth::user()->hasRole('karyawan'))
                                    <div class="text-right">


                                        @if (!empty($filter))

                                            <a href="{{ route('absensi.export.pdf', [$absensi->periode, $filter]) }}"
                                                class="btn btn-danger btn-sm" id="export-pdf">
                                                <i class="fa fa-file-pdf-o fa-fw"></i> Export PDF
                                            </a>
                                        @else

                                            <a href="{{ route('absensi.export.pdf', [$absensi->periode, 'all']) }}"
                                                class="btn btn-danger btn-sm" id="export-pdf">
                                                <i class="fa fa-file-pdf-o fa-fw"></i> Export PDF
                                            </a>
                                        @endif



                                    </div>
                                @endif
                            </div>
                            <div id="loading"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.6-rc.1/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2({
            placeholder: 'Filter Data..'
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#export-excel').on("click", function() {
            $(this).addClass('disabled');
            setTimeout(RemoveClass, 1000);
        });

        $('#export-pdf').on("click", function() {
            $(this).addClass('disabled');
            setTimeout(RemoveClass, 1000);
        });

        function RemoveClass() {
            $('#export-excel').removeClass("disabled");
        }

        var count = $(".count_date_absen").length
        $(".not_absen").attr("colspan", count);
    </script>
@endsection
