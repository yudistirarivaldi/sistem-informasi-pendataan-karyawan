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
                                    <span><i class="fa fa-search"></i> </span>
                                </div>
                            </div>
                            <input type="search" placeholder="Search" aria-label="Search..."
                                class="form-control input-flat border-0" id="search">
                        </div>
                        <a href="{{ route('master.staff.create') }}"
                            class="btn btn-default app-shadow d-none d-md-inline-block ml-auto">
                            <i class="fas fa-user-plus fa-fw"></i> Tambah
                        </a>
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
                                Data Karyawan
                                <span id="count"
                                    class="badge badge-dark float-right float-xl-right mt-1">{{ $count }}</span>
                            </div>
                            <table id="datatable" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tgl. Lahir</th>
                                        <th>Alamat</th>
                                        <th>No. Telpon</th>
                                        <th>Position</th>
                                        <th>Departement</th>
                                        <th class="text-center" style="width: 100px;">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $item)
                                        <tr id="hide{{ $item->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name ?? '' }}</td>
                                            <td>{{ $item->nik ?? '' }}</td>
                                            <td>{{ $item->jenis_kelamin ?? '' }}</td>
                                            <td>{{ $item->birth ?? '' }}</td>
                                            <td>{{ $item->addres ?? '' }}</td>
                                            <td>{{ $item->phone ?? '' }}</td>
                                            <td style="line-height: 1">
                                                {{ $item->position->name ?? '' }} <br>
                                                <small><span
                                                        class="badge {{ $item->position->status == 'Staff' ? 'badge-info' : 'badge-secondary' }}">{{ $item->position->status ?? '' }}</span></small>
                                            </td>
                                            <td>{{ $item->departement->name ?? '' }}</td>
                                            <td class="text-center">
                                                <a href="#" class="text-secondary nav-link p-0" role="button"
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('master.staff.edit', $item->id) }}">
                                                        <i class="far fa-edit mr-1"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onClick="hapus({{ $item->id }})">
                                                        <i class="far fa-trash-alt mr-2"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="card-footer">
                                <div class="text-right">
                                    <a href="{{ route('master.staff.export.excel') }}" class="btn btn-success btn-sm"
                                        id="export-excel">
                                        <i class="fa fa-file-excel-o fa-fw"></i> Export Excel
                                    </a>

                                    <a href="{{ route('master.staff.export.pdf') }}" class="btn btn-danger btn-sm"
                                        id="export-pdf">
                                        <i class="fa fa-file-pdf-o fa-fw"></i> Export PDF
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('master.staff.create') }}"
        class="btn btn-lg rounded-circle btn-primary btn-fly d-block d-md-none app-shadow">
        <span><i class="fas fa-user-plus fa-sm align-middle"></i></span>
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
                    title: 'Yakin.. ?',
                    text: "Data anda akan dihapus. Tekan tombol yes untuk melanjutkan.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!',
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ URL::to('/master/staff/destroy') }}",
                            data: "id=" + id,
                            success: function(data) {
                                swal("Deleted", data.message, "success");
                                $("#count").html(data.count);
                                $("#hide" + id).hide(300);
                            }
                        });

                    } else {
                        swal("Canceled", "Anda Membatalkan! :)", "error");
                    }
                });
        }
    </script>
@endsection
