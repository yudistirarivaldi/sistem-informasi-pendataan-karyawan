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
                                </h3>
                                <div class="float-left offset-5 pt-1">
                                    <span class="d-none d-md-block d-lg-block">{{ $title ?? '' }}</span>
                                </div>
                                <div class="float-right row">
                                    <form action="{{ url()->current() }}">
                                        <div class="input-group">
                                            <select name="filter" class="form-control input-sm select2">
                                                <option value="">Tampilkan semua</option>
                                                @if (!empty($filter))
                                                    <option value="all">SHOW ALL</option>
                                                @endif
                                                @foreach ($position_id as $item)
                                                    <option value="{{ $item->position_id }}"
                                                        {{ $item->position_id == old('filter', $filter) ? 'selected' : '' }}>
                                                        {{ strtoupper($item->position->name) }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <div class="card-body p-3">
                                    <table class="table table-bordered mb-0" style="font-size: 14px;">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>No</th>
                                                <th>Staff</th>
                                                <th>Posisi</th>
                                                <th>Dari Kantor</th>
                                                <th>Tujuan Kantor</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($mutasi as $item)
                                                <tr style="line-height: 1;">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->staff->name ?? '' }}</td>
                                                    <td>{{ $item->position->name ?? '' }}</td>
                                                    <td>{{ $item->keterangan ?? '' }}</td>
                                                    <td>{{ $item->dari ?? '' }}</td>
                                                    <td>{{ $item->ke ?? '' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="9">Tidak ada data untuk ditampilkan
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    @if (!empty($filter))
                                        <a href="{{ route('laporan.mutasi.export.pdf', $filter) }}"
                                            class="btn btn-danger btn-sm" id="export-pdf">
                                            <i class="fa fa-file-pdf-o fa-fw"></i> Export PDF
                                        </a>
                                    @else
                                        <a href="{{ route('laporan.mutasi.export.pdf', 'all') }}"
                                            class="btn btn-danger btn-sm" id="export-pdf">
                                            <i class="fa fa-file-pdf-o fa-fw"></i> Export PDF
                                        </a>
                                    @endif
                                </div>
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
    @include('alert.mk-notif')
    <script>
        $('.select2').select2({
            placeholder: 'Status..'
        });
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#export-excel').on("click", function() {
            $(this).addClass('disabled');
            setTimeout(RemoveClass, 1000);
        });

        function RemoveClass() {
            $('#export-excel').removeClass("disabled");
        }
    </script>
@endsection
