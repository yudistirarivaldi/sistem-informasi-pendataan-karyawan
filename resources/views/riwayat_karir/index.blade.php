@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
    <div class="content-wrapper pb-3">
        <div class="content-header">
            <div class="container-fluid">
                <form>
                    <div class="form-inline">
                        <div class="input-group app-shadow">
                            <div class="input-group-append">
                                <div class="input-group-text bg-white border-0">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            <input type="search" id="search" placeholder="Search" aria-label="Search..."
                                class="form-control input-flat border-0">
                        </div>
                        {{-- @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('mutasi.create') }}"
                                class="btn btn-default app-shadow d-none d-md-inline-block ml-auto">
                                <i class="fas fa-user-plus fa-fw"></i> Tambah
                            </a>
                        @endif --}}
                    </div>
                </form>
            </div>
        </div>

        <div class="content pb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                Data Riwayat Karir Karyawan
                                <span id="count"
                                    class="badge badge-dark float-right mt-1">{{ $count }}</span>
                            </div>
                            <table id="datatable" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Staff</th>
                                        <th>Dari Posisi</th>
                                        <th>Ke Posisi</th>
                                        <th>Keterangan</th>
                                        @if (Auth::user()->hasRole('admin'))
                                            <th class="text-center" style="width: 100px;">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat_karir as $item)
                                        <tr id="hide{{ $item->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->staff->name ?? '-' }}</td>
                                            <td>{{ $item->position->name ?? '-' }}</td>
                                            <td>{{ $item->positionNew->name ?? '-' }}</td>
                                            <td>
                                                {{ $item->keterangan ?? '-' }}<br>
                                                <small class="text-muted">
                                                    ({{ $item->position->name ?? '-' }} → {{ $item->positionNew->name ?? '-' }})
                                                </small>
                                            </td>
                                            @if (Auth::user()->hasRole('admin'))
                                                <td class="text-center">
                                                    <a href="#" class="text-secondary nav-link p-0" role="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item"
                                                            href="{{ route('staff.karir.edit', $item->id) }}">

                                                            <i class="far fa-edit mr-1"></i> Edit
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onClick="hapus({{ $item->id }})">
                                                            <i class="far fa-trash-alt mr-2"></i> Hapus
                                                        </a>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('schedule.create') }}"
        class="btn btn-lg rounded-circle btn-primary btn-fly d-block d-md-none app-shadow">
        <i class="fas fa-user-plus fa-sm align-middle"></i>
    </a>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert-dev.js') }}"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        function hapus(id) {
            swal({
                title: 'Yakin?',
                text: "Data anda akan dihapus. Tekan tombol Yes untuk melanjutkan.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ URL::to('/riwayatkarir/destroy') }}",
                        data: "id=" + id,
                        success: function(data) {
                            swal("Deleted", data.message, "success");
                            $("#count").html(data.count);
                            $("#hide" + id).hide(300);
                        }
                    });
                } else {
                    swal("Canceled", "Anda membatalkan aksi!", "error");
                }
            });
        }
    </script>
@endsection
